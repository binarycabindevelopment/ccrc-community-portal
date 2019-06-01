<template>
    <div class="listing-search-container">
        <div class="autocomplete-container relative">
            <input autocomplete="off" name="query" @input="searchCommunities()" v-model="query" class="w-full h-16 px-3 rounded focus:outline-none focus:shadow-outline text-xl px-8 shadow-lg" type="search" placeholder="Search Community Name, City, or Zipcode">
            <div class="autocomplete-items" v-if="showFilteredCommunities">
                <div v-for="filteredCommunity in filteredCommunities" class="autocomplete-item" v-on:click="setQuery(filteredCommunity.name+', '+filteredCommunity.city+', '+filteredCommunity.state+' '+filteredCommunity.zipcode)">
                    {{ filteredCommunity.name }}, {{ filteredCommunity.city }}, {{ filteredCommunity.state }} {{ filteredCommunity.zipcode }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['communities','value'],
        data: function () {
            return {
                count: 0,
                query: this.value,
                filteredCommunities: [],
                showFilteredCommunities: true,
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            searchCommunities: function(){
                this.showFilteredCommunities = true;
                if(this.query && Array.isArray(this.searchableCommunities) && this.searchableCommunities.length > 0){
                    this.$search(this.query, this.searchableCommunities, {
                        keys: ['name','city','state','zipcode']
                    }).then(results => {
                        if(results.length > 5){
                            this.filteredCommunities = results.slice(0,5);
                        }else{
                            this.filteredCommunities = results;
                        }

                    });
                }else{
                    this.filteredCommunities = [];
                }
            },
            setQuery: function(value){
                this.query = value;
                this.showFilteredCommunities = false;
            }
        },
        computed: {
            searchableCommunities: function(){
                let items = [];
                if(Array.isArray(this.communities)){
                    for(var i=0;i<this.communities.length;i++){
                        let community = this.communities[i];
                        let item = {
                            id: community.id,
                            uuid: community.uuid,
                            name: community.name,
                            city: community.city,
                            state: community.state,
                            zipcode: community.zipcode,
                        };
                        items.push(item);
                    }
                }
                return items;
            }
        }
    }
</script>
