<template>

    <div class="container">
        <div class="row justify-content-center">
            <aside class="col-lg-3 col-md-4">
                <filters :maximum="maximum" :minimum="minimum" @modified="modified"/>
            </aside>
            <div class="col-lg-9 col-md-8">
                <div class="border rounded p-3 bg-white">
                    <div class="border bg-light rounded p-2">
                        <div class="form-group row m-0">
                            <div class="col-md-8">
                                <input type="text" class="form-control form-control-sm" v-model="name" placeholder="Search by name...">
                            </div>
                            <div class="col-md-4">
                                <select v-model="sortby" class="form-control form-control-sm">
                                    <option value="">Sort by</option>
                                    <option value="price_asc">Price (ascending)</option>
                                    <option value="price_desc">Price (descending)</option>
                                    <option value="name_asc">Name (A-Z)</option>
                                    <option value="name_desc">Name (Z-A)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div v-if="houses.length > 0" class="my-3">
                        <InfiniteScroll @at-the-bottom="fetchData(houses.length)">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Bedrooms</th>
                                        <th>Bathrooms</th>
                                        <th>Garages</th>
                                        <th>Storeys</th>
                                    </tr>
                                    <tr v-for="(house, index) in houses" v-bind:key="index">
                                        <td>{{ house.name }}</td>
                                        <td>{{ preformat(house.price) }}</td>
                                        <td>{{ house.bedrooms }}</td>
                                        <td>{{ house.bathrooms }}</td>
                                        <td>{{ house.garages }}</td>
                                        <td>{{ house.storeys }}</td>
                                    </tr>
                                </table>
                            </div>
                        </InfiniteScroll>
                    </div>
                    <div v-if="houses.length < 1 && !loading">
                        <h4 class="my-5 text-center">No house matching your records</h4>
                    </div>
                    <div v-show="loading" class="my-5 text-center">
                        <img src="/loading.png" alt="loading" title="loading" id="loading" width="50">
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

    import InfiniteScroll from "./InfiniteScroll"
    import Filters from "./Filters"

    export default {

        props:[
            'maximum', 'minimum' // Properties from database with lowest and highest price to assign variables "min" and "max"
        ],

        components:{
            InfiniteScroll, Filters
        },

        data(){

            return{
                name:'',
                loading:true,
                houses:[],
                features:{},
                sortby:'',
                stop: false // This variable needs to stop infinite scrolling
            }

        },

        created(){
            this.fetchData();
        },

        watch:{

            sortby(value){

                switch(value){

                    case('price_asc'):
                        this.houses.sort((a,b) => parseInt(a.price) - parseInt(b.price));
                        break;
                    case('price_desc'):
                        this.houses.sort((a,b) => parseInt(b.price) - parseInt(a.price));
                        break;
                    case('name_asc'):
                        this.houses.sort((a,b) => a.name.localeCompare(b.name));
                        break;
                    case('name_desc'):
                        this.houses.sort((a,b) => b.name.localeCompare(a.name));
                        break;
                    default:
                        this.houses;

                }

            },

            name(){

                const name = {
                    name: this.name.trim() !== '' ? this.name : null
                };

                delete this.features.name;
                return this.features = {...this.features, ...name};

            },

            features:_.debounce(function(){

                this.stop = false;
                this.sortby = '';
                this.houses = [];
                return this.fetchData();

            }, 500) // Every modification handled in property "Features" will be dispatched to server after 500 ms

        },

        methods:{

            modified(value){
                return this.features = {...this.features, ...value};
            },

            preformat(x){
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
            },

            fetchData(offset = 0){

                if(!this.stop){

                    this.loading = true;
                    this.features.offset = offset;

                    axios.post('/api/houses', this.features)
                    .then(response => {
                        this.houses = this.houses.concat(response.data);
                        this.stop = response.data.length === 0;
                    }).finally(() => this.loading = false)

                }

            }

        }


    }

</script>

<style scoped>

    #loading{
        animation: 1s rotate infinite;
    }
    @keyframes rotate{
        0%{transform:rotate(0deg);}
        100%{transform:rotate(360deg);}
    }

</style>
