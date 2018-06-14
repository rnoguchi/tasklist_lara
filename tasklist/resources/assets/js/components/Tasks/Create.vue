<template>
    <div>
        <div class="row">
            <div class="col-md-11">
                <div v-if="errors != null">
                    <div class="alert alert-danger">
                        <ul v-for="error in errors">
                            <li>{{error}}</li>
                        </ul>
                    </div>
                </div>
                <div v-if="success != null">
                    <p><b>更新しました</b></p>
                </div>
            </div>
            <div class="col-md-1">
                <router-link to="/tasks" class="float-right btn btn-secondary" role="button">戻る</router-link>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form>
                    <div class="form-group">
                        <label>タイトル</label>
                        <input v-model="title" type="title" class="form-control" id="title" placeholder="タイトル">
                        <small class="text-muted">30文字くらいにおさめてください</small>
                    </div>
                    <div class="form-group">
                        <label>本文</label>
                        <input v-model="body" type="body" class="form-control" id="body" placeholder="本文">
                        <small class="text-muted">300文字くらいにおさめてください</small>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="float-right btn btn-primary" role="button" v-on:click="save">保存</div>
                </div>
                <div class="col-md-3"></div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                errors: null,
                success: null,
            }
        },
        methods: {
            save() {
                this.$http.post(
                    '/oauth/token',
                    {
                        "grant_type": "client_credentials",
                        "client_id": "1",
                        "client_secret": "yB2UUBWXhQ6iBaBqslrHX1w77Ku9RFPKJlOw19Si",
                        "scope": "*"
                    }
                ).then(res => {
                    var task = {
                        'title': this.title,
                        'body': this.body
                    }
                    this.$http.post(
                        '/api/tasks/create',
                        task,
                        {
                            headers: {
                                Accept: 'application/json',
                                Authorization: 'Bearer ' + res.data.access_token
                            }
                        }
                    ).then(res => {
                            if (res.data.status && res.data.status == 'success') {
                                this.success = res.data.status
                                this.errors = null
                            } else {
                                this.errors = res.data
                                this.success = null
                            }

                        }
                    ).catch(errors => {
                            this.errors = errors
                        }
                    )
                })
            }
        }
    }
</script>