<template>
    <div>
        <form @submit.prevent="create">
            <div class=" form-group">
                <input name="todoItem" id="todoItem"  @keyup.enter="handleSubmit" @keyup.esc="clearText" v-model="todoItem" type="text" class="form-control" placeholder="What needs to be done?">
            </div>
        </form> 
    </div>
    
</template>

<script>
export default {
    data(){
            return {
                todoItem: ''
            }
        },
    methods: {
            create(){
                if(this.todoItem != ''){                    
                    axios.post(`/todos`, {
                        name: this.todoItem
                    })
                    .catch(error => {
                        alert(error.response.data.message);
                    })
                    .then(({data}) =>{
                        this.$emit('created_1', data.NewTask);
                        this.$emit('created_2', data.todoList); 
                    })
                }
            },
            handleSubmit () {
                if (this.todoItem.trim()) {
                    this.todoItem = ''
                }
            },
            clearText () {
                this.todoItem = ''
            }
        }
    
}
</script>