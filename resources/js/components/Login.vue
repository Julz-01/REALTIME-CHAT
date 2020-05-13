<template>
	<div>
		  <div class="card">
                <div class="card-header">Login</div>

                <div class="card-body">
                    <form method="POST" @submit.prevent="attemptLogin">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-mail Address</label>

                            <div class="col-md-6">
                               <input id="email" type="email" class="form-control"  v-model="form.email" autocomplete="email" autofocus :class="{ 'is-invalid' : form.errors.has('email') }" @keydown="form.errors.clear('email')">
        <div class="invalid-feedback" v-show="form.errors.has('email')" v-text="form.errors.get('email')"></div>
                            
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control"  v-model="form.password" autocomplete="current-password" :class="{ 'is-invalid' : form.errors.has('password') }" @keydown="form.errors.clear('password')">
        <div class="invalid-feedback" v-show="form.errors.has('password')" v-text="form.errors.get('password')"></div>
                           
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                               Login
                                </button>
                        
                                    <a class="btn btn-link" href="#">
                                        Forgot your password
                                    </a>
                        
                            </div>
                        </div>
                    </form>
                </div>
            </div>
	</div>
</template>
<script>
	export default{
		data(){
			return{
				form: new Form({
					email: '',
					password: ''
				})
			}
		},
		methods:{
			attemptLogin(){
				let data = new FormData();
				data.append('email', this.form.email);
				data.append('password', this.form.password);

				axios.post('/user/login', data)
				.then( (response)=> {
					window.location = '../home';

				})
				.catch(error => this.form.errors.record(error.response.data))
			}
		}
	}
</script>