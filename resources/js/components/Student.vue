<template>
	<div>
		<div class="card">
			<div class="card-header">{{form.name}}</div>
			<div class="card-body">
				<form method="POST"  @submit.prevent="submitData()">
					<div class="form-group">
						<div class="row">
							<div class="col-md-12">
								<input type="text" class="form-control" :class="{ 'is-invalid' : form.errors.has('name') }" v-model="form.name" @keydown="form.errors.clear('name')">
	<div class="invalid-feedback" v-show="form.errors.has('name')" v-text="form.errors.get('name')"> </div>
							</div>
							<div class="col-md-12">
								<input type="text" class="form-control mt-2" v-model="form.number" :class="{ 'is-invalid' : form.errors.has('number') }" @keydown="form.errors.clear('number')">
	<div class="invalid-feedback" v-show="form.errors.has('number')" v-text="form.errors.get('number')"> </div>
							</div>
							<div class="col-md-12">
								<button class="btn btn-outline-dark btn-block mt-2">ADD</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		
		<div class="card mt-3">
			<div class="card-header">title</div>
			<div class="card-body">
<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Name</th>
      <th scope="col">Number</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="student in mutableStudent">
      <td>{{student.id}}</td>
      <td>{{student.name}}</td>
      <td>{{student.number}}</td>
      <td><button class="btn btn-outline-light btn-sm" @click.prevent="deleteData(student)">delete</button>
		<button class="btn btn-outline-light btn-sm" data-toggle="modal" :data-target="'#editModal' + student.id">edit</button>
      </td>
       <div class="modal fade" :id="'editModal' + student.id" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="editModalLabel">{{student.name}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
        	<form method="POST">	
        	<div class="row">
        		<div class="col-md-12">
        		<input type="text" v-model="student.name" class="form-control">
        		<input type="text" v-model="student.number" class="form-control mt-2">
        		</div>
        	</div>
        </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" @click="updateData(student)">Save</button>
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
		props:['students'],
		data(){
			return{
				form: new Form({
					name: '',
					number: '',
				}),
				mutableStudent: this.students
			}
		},
		methods:{
			submitData(){
				let data = new FormData();
				data.append('name', this.form.name);
				data.append('number', this.form.number);

				axios.post('/store/student', data)
				.then( (response)=> {
				this.form.reset();
				this.getData();
				})
				.catch(error => this.form.errors.record(error.response.data));
			},
			getData(){
				axios.get('/get/student')
				.then( (response) => {
				this.mutableStudent = response.data;
				})
				.catch( error => (error.response.data));
			},
			deleteData(student){
				axios.post('/destroy/student/'+ student.id)
				.then( (response) => {
				this.getData();
				})
				.catch(error => error.response.data);
			},
			updateData(student){
				let data = new FormData();
				data.append('name', student.name);
				data.append('number', student.number);

				axios.post('/update/student/'+ student.id, data)
				.then( (response) => {
					$('#editModal' + student.id).modal('hide');
				})
				.catch(error => (error.response.data));
			}
		}
	}
</script>