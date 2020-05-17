<template>
    <div>
        <form @submit.prevent="create">
            <div class=" form-group">
                <input name="todoItem" id="todoItem"  v-on:keyup.enter="handleSubmit" v-on:keyup.esc="clearText" v-model="todoItem" type="text" class="form-control" placeholder="What needs to be done?">
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
                axios.post(`/todos`, {
                    name: this.todoItem
                })
                .catch(error => {
                    alert(error.response.data.message);
                })
                .then(({data}) =>{
                    this.$emit('created', data.NewTask);
            })
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