<template>
	<div>
		  <div class="card">
            <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <div class="row">

  <table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Email</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr  v-for="user in mutableUser">
      <td>{{user.name}}</td>
      <td>{{user.email}}</td>
      <td>{{user.id}}</td>
      <td v-if="user.id == Auth">
  </td>
  <td v-else>
      <button class="btn btn-outline-light btn-sm" @click.prevent="deleteUser(user)">Delete</button>
  </td>
    </tr>
  </tbody>
</table>

                    </div>
                </div>
            </div>
	</div>
</template>
<script>
Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');
	export default{
		props: ['users'],
		data(){
			return{
		    mutableUser: this.users,
        Auth: this.$userId
			}
		},
		methods:{
			deleteUser(user){
	 Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'delete it!'
	}).then((result) => { // <--
    if (result.value) { // <-- if confirmed
  		axios.post('/delete/'+user.id)
				.then( (response)=> {
					Swal.fire({
  					position: 'center',
  					type: 'success',
  					title: user.name+ ' deleted',
  					showConfirmButton: false,
  					timer: 1500
					})
					this.getVueItems();
				
				})
				.catch(error =>{
					 console.log(error.response.data);
				})
    }
	});			
			},
				getVueItems(){
				axios.get('/users')
				.then( (response)=> {
				this.mutableUser = response.data;
				})
			}
		}
	}
</script>
