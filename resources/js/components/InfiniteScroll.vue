<template>
    <div>
        <slot/>
    </div>
</template>

<script>

    export default {

        created() {

            const eventHandler = () => {

                const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
                const viewPortHeight = window.innerHeight;
                const totalHeight = document.documentElement.offsetHeight;

                const atTheBottom = (scrollTop + viewPortHeight) * 1.2 > totalHeight;

                if(atTheBottom){
                    this.$emit('at-the-bottom');
                }

            };

            const delayedHandler = _.debounce(eventHandler, 400);

            document.addEventListener('scroll', delayedHandler);

        }

    }

</script>
