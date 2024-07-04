<template>
    <div>
        <v-navigation-drawer
            v-model="drawer"
           :mini-variant="drawer"
           permanent
           app
           color="#3b3b58" >
        <v-list-item v-for="(item, i) in items"
            :key="i"
            :to="item.to">
            <v-icon @click="drawer = !drawer" color="white"  
                class="toggleUpDown" :class='{ "rotate": drawer }'>{{item.icon}}</v-icon>
                <v-list-item-content>
                    <v-list-item-title style="color:white" class="mx-5">{{item.text}}</v-list-item-title>
                </v-list-item-content>
        </v-list-item>
        <v-divider></v-divider>
            <v-list
                nav
                dense>
                <v-list-item-group
                active-class="white">
               <v-list-item
                    v-for="(item, i) in navigation"
                    :key="i"
                    :to="item.to">
                    <v-list-item-icon >
                        <v-icon color="#7a5980">{{ item.icon }}</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title style="color:#7a5980">{{item.title}}</v-list-item-title>
                    </v-list-item-content>

                </v-list-item>
                </v-list-item-group>
            </v-list>
    </v-navigation-drawer>
    </div>
</template>

<script>
export default {
    data() {
        return {
            drawer: true,
            items:[
                {text:'Customer Information', icon:'mdi-chevron-double-left'}
            ],
             mini: true,
        }
    },

    computed: {
    navigation(){
            let nav = [
                {title:'Home', icon:'mdi-home', to:'home'}
            ]
            return nav;
    }      
},

}
</script>

<style scoped>
.toggleUpDown {
    transition: transform .3s ease-in-out !important;  
}
.toggleUpDown.rotate {
    transform: rotate(180deg);
}

</style>