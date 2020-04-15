<template>
    <div class="border p-3 rounded bg-white">
        <div class="form-group">
            <label for="bedrooms">Bedrooms</label>
            <input type="number" id="bedrooms" min="1" step="1" class="form-control form-control-sm" v-model="bedrooms">
        </div>
        <hr>
        <div class="form-group">
            <label for="bathrooms">Bathrooms</label>
            <input type="number" id="bathrooms" min="1" step="1" class="form-control form-control-sm" v-model="bathrooms">
        </div>
        <hr>
        <div class="form-group">
            <label for="garages">Garages</label>
            <input type="number" id="garages" min="1" step="1" class="form-control form-control-sm" v-model="garages">
        </div>
        <hr>
        <div class="form-group">
            <label for="storeys">Storeys</label>
            <input type="number" id="storeys" min="1" step="1" class="form-control form-control-sm" v-model="storeys">
        </div>
        <div class="form-group row mx-0">
            <div class="col-md-6 p-1">
                <label for="min">Min. price</label>
                <input type="text" id="min" class="form-control form-control-sm" v-model="min">
            </div>
            <div class="col-md-6 p-1">
                <label for="max">Max. price</label>
                <input type="text" id="max" class="form-control form-control-sm" v-model="max">
            </div>
        </div>
        <div class="form-group text-center mb-0">
            <button type="button" @click="reset" class="btn btn-success">Reset</button>
        </div>
    </div>
</template>


<script>

    export default{

        props:[
            'maximum', 'minimum' // Properties from database with lowest and highest price to assign variables "min" and "max"
        ],

        data(){

            return{
                bedrooms:'',
                bathrooms:'',
                garages:'',
                storeys:'',
                min:parseInt(this.minimum),
                max:parseInt(this.maximum),
            }

        },

        computed:{

            features(){


                return {

                    bedrooms: this.bedrooms.trim() !== '' ? this.bedrooms : null,
                    bathrooms: this.bathrooms.trim() !== '' ? this.bathrooms : null,
                    garages: this.garages.trim() !== '' ? this.garages : null,
                    storeys: this.storeys.trim() !== '' ? this.storeys : null,
                    min: this.min !== '' ? this.min : null,
                    max: this.max !== '' ? this.max : null,

                }
                // This property collects all the features and controls whether one of its key modified to send the data to server

            }

        },

        watch:{


            max(){
                this.max = this.max.replace(/[^0-9]/g, ''); // Regular expression to allow only numbers
            },

            min(){
                this.min = this.min.replace(/[^0-9]/g, ''); // Regular expression to allow only numbers
            },

            features(){
                return this.$emit('modified', this.features);
            }

        },

        methods:{

            reset(){

                this.garages = this.storeys = this.bathrooms = this.bedrooms = '',
                this.max = this.maximum;
                this.min = this.minimum;

            }

        }

    }

</script>
