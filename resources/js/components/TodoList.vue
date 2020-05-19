<template>
    <div>    
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h1 class="text-center">todos</h1></div>

                    <div class="card-body">                    
                        <new-todo @created_1="add" @created_2="TaskLeft"></new-todo>
                        <div v-if="list == 'complete'">
                            <todo @created_1="TaskAll" @created_2="TaskDone" @created_3="TaskLeft" v-for="todos in todoDone" :todoItems="todos" :key="todos.id"></todo>
                        </div>
                        <div v-else-if="list == 'incomplete'">
                            <todo @created_1="TaskAll" @created_2="TaskDone" @created_3="TaskLeft" v-for="todos in todoLeft" :todoItems="todos" :key="todos.id"></todo>
                        </div>
                        <div v-else>
                            <todo @created_1="TaskAll" @created_2="TaskDone" @created_3="TaskLeft" v-for="todos in todoItems" :todoItems="todos" :key="todos.id"></todo>
                        </div>
                        <div v-if="todoItems.length>0" class="row border-top mt-2 pt-2">
                            <div class="col-3">
                                {{ TaskRemain }} 
                            </div>
                            <div class="col-6 text-center">
                                <a @click="list = 'all'" type="button" class="btn text-decoration-none" :class="classes_1">All</a>
                                <a @click="list = 'incomplete'" type="button" class="btn text-decoration-none" :class="classes_2">Active</a>
                                <a @click="list = 'complete'" type="button" class="btn text-decoration-none" :class="classes_3">Completed</a>
                            </div>
                            <div class="col-3 text-right">
                                <a @click="destroy" class="btn text-muted text-decoration-none">Clear Completed</a>
                            </div>
                        </div>
                    </div>               
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Todo from './Todo.vue';
import NewTodo from './NewTodo.vue';
    export default {
        components: {Todo, NewTodo},

        props: ['todo', 'todoremain', 'todocomplete'],

        data(){
            return {
                todoItems: [],
                todoLeft: [],
                todoDone: [],
                count: 0,
                list: 'all',
                id: 'complete'
            }
        },

        created(){
            this.todoItems = this.todo;
            this.todoLeft = this.todoremain;
            this.todoDone = this.todocomplete;
            this.count = this.todoremain.length;
        },

        methods: { 
            destroy(){
                axios.delete(`/todos/${this.id}`)
                .catch(err => {
                    alert(err.response.data.message);
                })
                .then(({data})=>{
                    this.todoItems = data.FullList;
                    this.todoDone = data.CompleteList;
                    this.todoLeft = data.IncompleteList;                 
                });
            },           
            add(NewTask){
                this.todoItems.push(NewTask);
            },

            TaskAll(FullList){
                this.todoItems = FullList;
                this.count = this.todoLeft.length;
            },

            TaskDone(CompleteList){
                this.todoDone = CompleteList;
                this.count = this.todoLeft.length;
            },

            TaskLeft(IncompleteList){
                this.todoLeft = IncompleteList;
                this.count = this.todoLeft.length;
            }
        },

        computed: {
            TaskRemain(){
                return this.count + " " + (this.count > 1 ? 'items left' : 'item left');
            },

            classes_1(){
                return[ 
                    this.list == 'all' ? 'font-weight-bold text-success' : 'text-muted'
                ]
            },

            classes_2(){
                return[ 
                    this.list == 'incomplete' ? 'font-weight-bold text-success' : 'text-muted'
                ]
            },

            classes_3(){
                return[ 
                    this.list == 'complete' ? 'font-weight-bold text-success' : 'text-muted'
                ]
            }
        }
    }
</script>