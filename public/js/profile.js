Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");

new Vue({
  el :'#profile',
  data :{
    image:'',
    isValid:'',
    fileName:'',
    profile: [],
  },
  ready: function() {
    this.getVueItems();
  },
  methods: {
    getVueItems: function(id) {
      this.$http.get('/api/settings').then((response) => {
        this.$set('profile', response.data.data);
      });
    },
    onFileChange(e){
      this.image='';
      var files=e.target.files||e.dataTransfer.files;
      if(!files.length) 
        return;
      this.image=files[0];
    },

    uploadEdit:function(){
      this.isValid=window.profile;
      if(this.image!=''){
        let data = new FormData();
        data.append('file',this.image);
        this.$http.post('/api/settings/logo/',data).then((response) => {
          this.fileName=response.data;
          this.image='';
          this.updateItem();
        });
      }
      else{
        this.updateItem();
      }
    },
    updateItem: function() {
      if(this.fileName!=''){
        this.profile.logo_image=this.fileName;
      }
      var input = this.profile;
      var ini=this;
      if(ini.isValid){
        swal({
              title: "Are You Sure?",
              text: "You Will Update Your Profile",
              type: "info",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes",
              closeOnConfirm: false
            },
            function(isConfirm){
              if(isConfirm){
                ini.$http.put('/api/settings/',input).then((response) => {
                  ini.getVueItems();
                }, (response) => {
                  ini.formErrors = response.data;
                });
                swal("Success","Your Profile Has Been Updated", "success");              
              }             
      });  
      }     
    },
  }
});