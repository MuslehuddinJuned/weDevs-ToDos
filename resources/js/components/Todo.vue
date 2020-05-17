<template>
<div>  
        <div class="input-icons w-100">
            <!-- <div v-html="todoItem"></div> -->
            <!-- {{ todoItems.name }} -->
            <i v-if="complete" @click="incomplete" class="far fa-check-circle icon text-success"></i>
            <i v-else @click="completed" class="far fa-circle icon text-secondary"></i>
            <input  name="todoItem" v-model="todoItem" @keyup="updateTask" class="input-field border-0 w-100 lead" :class="classes" type="text">
            <i @click="destroy" class="fas fa-times icon text-light"></i>      
        </div>
</div>
</template>

<script>
    export default {
        props: ['todoItems'],
        data(){
            return {
                id: this.todoItems.id,
                todoItem: this.todoItems.name,
                complete: this.todoItems.complete
            }
        },
        methods: {
            destroy(){
                axios.delete(`/todos/${this.id}`)
                .catch(err => {
                    alert(err.response.data.message);
                })
                .then(res=>{
                    $(this.$el).fadeOut(200)
                   
                });
            },

            updateTask(){
                axios.patch(`/todos/${this.id}`, {
                    name: this.todoItem
                })
                .catch(err => {
                    alert(err.response.data.message);
                });
            },

            completed(){
                axios.patch(`/todos/${this.id}`, {
                    complete: 'Yes'
                })
                .then(({data}) => {
                    this.complete = true;
                    this.count++;
                })
                .catch(err => {
                    alert(err.response.data.message);
                });
            },

            incomplete(){
                axios.patch(`/todos/${this.id}`, {
                    complete: null
                })
                .catch(err => {
                    alert(err.response.data.message);
                })
                .then(({data}) => {
                    this.count--;
                    this.complete = false;
                })
            }
        },

        computed: {
            classes(){
                return[ 
                    this.complete ? 'text-secondary lineThrough' : ''
                ]
            }
        }
    }
</script>