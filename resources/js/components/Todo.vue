<template>
<div>  
    <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <h2>{{ todo.name }}</h2> {{todo.id}}                   
                <div class="ml-auto">
                    <button @click="destroy" class="btn btn-outline-danger">Delete</button>
                </div>
            </div>
            
        </li>
    </ul>
</div>
</template>

<script>
    export default {
        props: ['todo'],
        data(){
            return {
                id: this.todo.id
            }
        },
        methods: {
            destroy(){
                axios.delete(`/todos/${this.id}`)
                .then(res=>{
                    $(this.$etl).fadeout(500, () =>{
                        alert(res.data.message);
                    })
                });
            }
        }
    }
</script>