<template>
<span>
    <span v-if="item && !bootstrap">
        <a 
            v-on:click="writeForm()"
            v-if="type == 'link'"
            v-bind:href="'#' + custom" 
            v-bind:class="css"
            class="waves-effect waves-light m-r-5 m-b-10" 
            v-bind:data-animation="animation" 
            data-plugin="custommodal"
            data-overlaySpeed="300" 
            data-overlayColor="#36404a"><span v-bind:class='icon'></span> {{title}}
        </a>
    </span>

    <span v-if="!item && !bootstrap">
        <a 
            v-if="type == 'link'"
            v-bind:href="'#' + custom" 
            v-bind:class="css"
            class="waves-effect waves-light m-r-5 m-b-10" 
            v-bind:data-animation="animation" 
            data-plugin="custommodal"
            data-overlaySpeed="200" 
            data-overlayColor="#36404a"><span v-bind:class='icon'></span> {{title}}
        </a>
    </span>

    <span v-if="!item && !bootstrap">
        <a 
            v-if="type == 'link'"
            v-bind:href="'#' + custom" 
            v-bind:class="css"
            class="waves-effect waves-light m-r-5 m-b-10" 
            v-bind:data-animation="animation" 
            data-plugin="custommodal"
            data-overlaySpeed="200" 
            data-overlayColor="#36404a"><span v-bind:class='icon'></span> {{title}}
        </a>

    </span>

    <span v-if="item && bootstrap">      
  <div class="button-list">
        <button 
            v-on:click="writeForm()"
            v-if="type=='button'"
            v-bind:class="css"
            class="waves-effect waves-light m-r-5 m-b-10" 
            data-toggle="modal" 
            v-bind:data-target="'#'+target">
            <span v-bind:class='icon'></span> {{title}}
        </button>
    </div>
    </span>

    <span v-if="!item && bootstrap">      
  <div class="button-list">
        <button 
            v-if="type=='button'"
            v-bind:class="css"
            class="waves-effect waves-light m-r-5 m-b-10" 
            data-toggle="modal" 
            v-bind:data-target="'#'+target">
            <span v-bind:class='icon'></span> {{title}}
        </button>
</div>
    </span>

    <span v-if="item && bootstrap">      
        <a  v-on:click="writeForm()"

            v-if="type=='link'"
            v-bind:class="css"
            class="waves-effect waves-light m-r-5 m-b-10" 
            data-toggle="modal" 
            v-bind:data-target="'#'+target">
              <span v-bind:class='icon'></span> {{title}}
        </a>
    </span>

    <span v-if="!item && bootstrap">      
        <a 
            v-if="type=='link'"
            v-bind:class="css"
            class="waves-effect waves-light m-r-5 m-b-10" 
            data-toggle="modal" 
            v-bind:data-target="'#'+target">
              <span v-bind:class='icon'></span> {{title}}
        </a>
    </span>

</span>
</template> 

<script>
    export default {
        props: ['item','type', 'title', 'animation', 'css', 'custom', 'overlay', 'icon', 'url', 'bootstrap', 'target'],
        methods:{
            writeForm: function(){
             axios.get(this.url + this.item.id).then(res => {
                this.$store.commit('setItem', res.data);    
            });
            // this.$store.commit('setItem', this.item);    
            }
        }
    }
</script>
