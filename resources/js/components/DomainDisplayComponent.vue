<template>
<div>
	<div class="row">
	<div class="col-md-12">
	<div class="w-100 aligh-items-center py-1" @click="selectedAll()">
	<h5 class="text-center mt-5">Show all links</h5>
	</div>
	</div>
		<div class="p-2 col-4" v-for="category in this.categories">
		<button class="btn btn-outline-dark btn-block" @click="selectedCat(category.id)">{{category.categoryname}}</button>
		</div>
	</div>

	<div class="row">
	<div class="py-2 col-12" v-for="subcategory in filteredSubCategories">
	<button class="btn btn-outline-dark btn-block" @click="selectedsubCat(subcategory.id)">{{subcategory.subcategoryname}}</button>
	</div>
	</div>

	<div class="row">
		<div class="col-md-6" v-for="domain in filteredDomains">
			<div class="card mt-2">
				<div class="card-body">
				<p><strong>Name:</strong>{{domain.title}}</p>
				<p><strong>URL:</strong> <a :href="domain.url">{{domain.url}}</a></p>
				</div>
			</div>
		</div>
	</div>

</div>
</template>

<script>
	export default {
	props: ['domains', 'categories', 'subcategories'],
	data (){
		return{
			selectedcategory: '',
			selectedsubcategory: '',
		}
	},
	methods: {
		selectedAll: function (){
			this.selectedcategory = '';
			this.selectedsubcategory = '';
		},
		selectedCat: function (id){
			this.selectedcategory = id;
			this.selectedsubcategory = '';
		},
		selectedsubCat: function (id){
			this.selectedsubcategory = id;
		}
	},
	computed: {
	filteredSubCategories: function (){
	return this.subcategories.filter((item) => item.category_id == this.selectedcategory);
	},
	filteredDomains: function (){
		if(this.selectedcategory === '' && this.selectedsubcategory === ''){
			return this.domains;
			}else if (this.selectedcategory === '' && this.selectedsubcategory != ''){
				return this.domains.filter((item) => item.subcategory_id == this.selectedsubcategory);
			}else if (this.selectedcategory != '' && this.selectedsubcategory === ''){
				return this.domains.filter((item) => item.subcategory_id == this.selectedsubcategory);
			}else if (this.selectedcategory != '' && this.selectedsubcategory != ''){
				return this.domains.filter((item) => item.subcategory_id == this.selectedsubcategory);
			}
		}
	}


	}
</script>