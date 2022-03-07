<template>
<div class="container">
  <form class="form-inline">
      <label class="sr-only" for="inlineFormInputName2">RIB:</label>
      <input type="text" v-model="valrib" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="12345123412345678912">

      <label class="sr-only" for="inlineFormInputGroupUsername2">Date début:</label>
      <div class="input-group mb-2 mr-sm-2">
          <input type="text" v-model="valdate1" class="form-control" id="inlineFormInputGroupUsername2" placeholder="YYYY-mm-dd">
      </div>
      <label class="sr-only" for="inlineFormInputGroupUsername2">Date fin:</label>
      <div class="input-group mb-2 mr-sm-2">
          <input type="text" v-model="valdate2" class="form-control" id="inlineFormInputGroupUsername2" placeholder="YYYY-mm-dd">
      </div>
  </form>
  <ListOperations ref="listoperation" :valdate1-prop="valdate1" :valrib-prop="valrib" :valdate2-prop="valdate2" />
</div>
</template>

<script>

import ListOperations from './ListOperations.vue'

  export default {
    name: 'TabForm',
    components: {
      ListOperations
    },

    data () {
        return {

            valrib: '',
            valdate1: '',
            valdate2: ''
        }
    },
    
    methods: {
      // recupere les données dans le controller PipeController.php
        fetchList () {

            axios.get ('http://127.0.0.1:8000/list-rib')
            .then (response => {
                this.$refs.listoperation.lists = response.data //pass list of operations to data lists of ListOperatios components
            })
            .catch (error => console.log(error))

        },
    },
    
    mounted () {
        
        this.fetchList ()
    }
  };
</script>