<template>
    <div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-11"></div>
                <div class="col-md-1">
                    <router-link to="/tasks/create" class="float-right btn btn-primary" role="button">新規作成</router-link>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div v-if="tasks != null">
                <div class="row">
                    <div class="col-md-6">
                        タイトル
                    </div>
                    <div class="col-md-6">
                        本文
                    </div>
                </div>
            </div>
            <div v-for="task in tasks">
                <div class="row">
                    <div class="col-md-6">
                        <router-link :to="'/task/' + task.id">{{ task.title }}</router-link>
                    </div>
                    <div class="col-md-6">
                        {{ task.body }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        async created() {
            this.fetchTasks()
        },
        data() {
            return {
                tasks: null,
                accessToken: null,
            }
        },
        methods: {
            fetchTasks() {
                this.$http.post(
                    '/oauth/token',
                    {
                        "grant_type": "client_credentials",
                        "client_id": "1",
                        "client_secret": "yB2UUBWXhQ6iBaBqslrHX1w77Ku9RFPKJlOw19Si",
                        "scope": "*"
                    }
                ).then(res => {
                    this.accessToken = res.data.accesss_token
                    this.$http.get(
                        '/api/tasks',
                        {
                            headers: {
                                Accept: 'application/json',
                                Authorization: 'Bearer ' + res.data.access_token
                            }
                        }
                    ).then(res =>  {
                            this.tasks = res.data
                    })
                })
            }
        }
    }
</script>
