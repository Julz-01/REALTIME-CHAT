<template>
	<div>
		    <div class="card">
                <div class="card-header">{{form.task}}</div>
                <div class="card-body">
                <div class="form-group">
                	<form method="POST" @submit.prevent="addTask()">
                	<div class="row">
                		<div class="col-md-12">
							<select class="form-control" id="name" v-model="form.name">
								<option v-for="user in users" :value="user.name">{{user.name}}</option>
							</select>
                		</div>
                		<div class="col-md-12">
                			<input type="text" :class="{ 'is-invalid' : form.errors.has('task') }" class="form-control mt-2" placeholder="task" v-model="form.task" @keydown="form.errors.clear('task')">
                			<div class="invalid-feedback" v-show="form.errors.has('task')" v-text="form.errors.get('task')">
						</div>
						<div class="mt-2"> 
                		<button class="btn btn-primary float-right btn-sm">add</button>
                		</div>
                		</div>
                	</div>
                </form>
                </div>
                </div>
             </div>

                 <div class="card mt-4">
                <div class="card-header">Task List</div>
                <div class="card-body">
					<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">task id</th>
      <th scope="col">Name</th>
      <th scope="col">Task</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="task in mutableTask">
      <th scope="row">{{task.id}}</th>
      <td>{{task.name}}</td>
      <td>{{task.task}}</td>
      <td><button class="btn btn-outline-dark btn-sm" @click.prevent="deleteTask(task)">delete</button>
      	<button class="btn btn-outline-dark btn-sm" data-toggle="modal" :data-target="'#editModal' + task.id">edit</button>
      </td>
 <div class="modal fade" :id="'editModal' + task.id" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">{{task.task}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
        	<form method="POST">	
        	<div class="row">
        		<div class="col-md-12">
        		<input type="text" v-model="task.name" class="form-control">
        		<input type="text" v-model="task.task" class="form-control mt-2">
        		</div>
        	</div>
        </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" @click="updateTask(task)">Save</button>
      </div>
    </div>
  </div>
</div>
    </tr>
  </tbody>
</table>
</div>
</div>
	</div>
</template>
<script>
	export default{
		props:['tasks','users'],
		data(){
			return{
				form: new Form({
					name: '',
					task: ''
				}),
				mutableTask: this.tasks
			}
		},
		methods:{
			addTask(){
				let data = new FormData();
				data.append('name', this.form.name);
				data.append('task', this.form.task);

			axios.post('/storage', data)
			.then( (response) =>{
				this.form.reset();
				Swal.fire({
  				 position: 'top',
 				 type: 'success',
  				 title:  'added succesfully',
  				 showConfirmButton: false,
  				 timer: 1500
				 })
				this.getTask();
			})
			.catch(error => this.form.errors.record(error.response.data));
			},
			getTask(){
				axios.get('/get/task')
				.then( (response)=> {
					this.mutableTask = response.data;
				})
				.catch(error =>{
					console.log(error.response.data);
				})
			},
			deleteTask(task){
				Swal.fire({
 				title: 'Are you sure?',
 				text: "You won't be able to revert this!",
  				icon: 'warning',
  				showCancelButton: true,
 				confirmButtonColor: '#3085d6',
 				cancelButtonColor: '#d33',
  				confirmButtonText: 'delete it!'
				}).then((result) => {
  				if (result.value) {
  				axios.post('/delete/task/' + task.id)
				.then( (response)=> {
				 	Swal.fire({
  					position: 'center',
  					type: 'success',
  					title: task.name+ ' deleted',
  					showConfirmButton: false,
  					timer: 1500
					})
					this.getTask();
				})
				.catch(error => {
					console.log(error.response.data);
				})
 				 }
				})
				
			},
			updateTask(task){
			let data = new FormData();
			data.append('name', task.name);
			data.append('task', task.task);

			axios.post('/update/task/'+task.id ,data)
			.then( (response)=> {
				 Swal.fire({
  				 position: 'top',
 				 type: 'success',
  				 title: task.task+' updated succesfully',
  				 showConfirmButton: false,
  				 timer: 1500
				 })
				 $('#editModal'+ task.id).modal('hide');
			})
			.catch(error => {
				console.log(error.response.data);
			})
			}
		}

		}
</script>
