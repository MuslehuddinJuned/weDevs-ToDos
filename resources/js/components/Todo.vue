<template> 
    <div>
        <div class="input-icons w-100" v-if="(todoItems.complete == 'Yes') && (list=='complete')">
            <i @click="incomplete" class="far fa-check-circle icon text-success"></i>
            <input  name="todoItem" v-model="todoItem" @keyup.enter="updateTask" @blur="updateTask" class="input-field border-0 w-100 lead" :class="classes" type="text">
            <i @click="destroy" class="fas fa-times icon text-light"></i>                 
        </div>  
        <div class="input-icons w-100" v-else-if="(todoItems.complete == null) && (list=='incomplete') ">
            <i @click="completed" class="far fa-circle icon text-secondary"></i>
            <input  name="todoItem" v-model="todoItem" @keyup.enter="updateTask" @blur="updateTask" class="input-field border-0 w-100 lead" :class="classes" type="text">
            <i @click="destroy" class="fas fa-times icon text-light"></i>                 
        </div>  
        <div class="input-icons w-100" v-else-if="list=='all'">
            <i v-if="complete" @click="incomplete" class="far fa-check-circle icon text-success"></i>
            <i v-else @click="completed" class="far fa-circle icon text-secondary"></i>
            <input  name="todoItem" v-model="todoItem" @keyup.enter="updateTask" @blur="updateTask" class="input-field border-0 w-100 lead" :class="classes" type="text">
            <i @click="destroy" class="fas fa-times icon text-light"></i>                 
        </div>            
    </div>

</template>

<script>
    export default {
        props: ['todoItems', 'list'],
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
                .then(({data})=>{
                    $(this.$el).fadeOut(200)
                    this.$emit('created_1', data.todoList);                  
                    this.$emit('created_2', data.todoList_count);                  
                });
            },

            updateTask(){
                axios.patch(`/todos/${this.id}`, {
                    name: this.todoItem
                })
                .then(({data}) => {
                    this.$emit('created_1', data.todoList);                  
                    this.$emit('created_2', data.todoList_count);  
                })
                .catch(err => {
                    alert(err.response.data.message);
                })
            },

            completed(){
                axios.patch(`/todos/${this.id}`, {
                    complete: 'Yes'
                })
                .then(({data}) => {
                    this.complete = true;
                    this.$emit('created_1', data.todoList);                  
                    this.$emit('created_2', data.todoList_count);  
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
                    this.complete = false;
                    this.$emit('created_1', data.todoList);                  
                    this.$emit('created_2', data.todoList_count);  
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