<template>
	<div>
	<form @submit.prevent="profileUpload" method="POST" enctype="multipart/form-data">
		<div v-if="imagepreview">
			<img :src="imagepreview" class="figure-img img-fluid rounded mt-2" style="max-height:100px;">			
		</div>
		<div class="custom-file">
			<input type="file" @change="selectimage" name="" class="custom-file-input" id="customFile">
			<label class="custom-file-label" for="customFile">Choose an image</label>
		</div>
		<button type="submit" class="btn btn-dark mt-2">Upload</button>
	</form>
</div>
</template>
<script>
	export default {
		data (){
		return{
				image: null,
				imagepreview: null,
			}
		},

		methods:{
			selectimage(e){
				this.image = e.target.files[0];
				let reader = new FileReader();
				reader.readAsDataURL(this.image);
				reader.onload = e => {
					this.imagepreview = e.target.result;
				};
			},

			profileUpload(){
				let data = new FormData;
				data.append('image', this.image);
				axios.post('/uploadimg', data)
				.then(()=>{
					window.location = '../profile';
				}).catch(()=>{

				})
			}
		}
	}
</script>