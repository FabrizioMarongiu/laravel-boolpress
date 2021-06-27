<template>
  <div class="container">
      <div v-if="post">
        <h1>{{post.title}}</h1>
        <div class="post-info">
            <span v-if="post.category">{{post.category.name}}</span>
            <div v-if="post.tags">
                <span v-for="tag in post.tags" :key="`tag-${tag.id}`" class="tag">* {{tag.name}} *</span>
            </div>
        </div>

        <div>
            {{post.content}}
        </div>

      </div>
      
          <Loader v-else />
      
  </div>

</template>

<script>
import axios from 'axios';
import Loader from '../components/Loader.vue';

export default {
    name:'PostDetail',
    components:{
        Loader,
    },
    data(){
        return{
            post: null,
        }
    },
    created(){
        this.getPostDetail()
    },
    methods:{
        getPostDetail(){
            axios.get(`http://127.0.0.1:8000/api/posts/${this.$route.params.slug}`)
                .then( res=> {
                    console.log(res.data)
                    this.post = res.data;
                })
                .catch(err =>{
                    console.log(err);
                });
        }
    }
}
</script>

<style lang="scss" scoped>
.tag{
    display: inline-block;
    margin: 6px;
    padding: 6px;
    border-radius: 5px;
    background-color: dodgerblue;
}
</style>