<template>
	<div>
		<div class="card">
                <div class="card-header">Profile of {{name}}</div>
                <div class="card-body"> 
                	<div class="form-group">
                <form method="POST" @submit.prevent="editUser">
                	<div class="row">
                		<div class="col-md-12">
                			<input type="text" class="form-control" v-model="name">
                		</div>
                		<div class="col-md-12 mt-2">
                			<input type="text" class="form-control" v-model="email">
                		</div>
                	</div>
                	<div class="mt-2">
                			<button class="btn btn-secondary">submit</button>
                	</div>
                </form>  
                </div>
            </div>
            </div>
	</div>	
</template>
<script>
	export default {
		props:['users'],
		data(){
			return{
				
				name: this.users.name,
				email: this.users.email
			
			}
		},
		methods:{
			editUser(){
				let data = new FormData();
				data.append('name', this.name);
				data.append('email', this.email);

				axios.post('/update/'+this.users.id,data)
				.then( (response)=> {
					 Swal.fire({
  				 position: 'top',
 				 type: 'success',
  				 title: this.name+' updated succesfully',
  				 showConfirmButton: false,
  				 timer: 1500
				 })

				})
				.catch()
			}
		}
	}
</script>
	
 