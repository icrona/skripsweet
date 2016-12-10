Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");

new Vue({
  el :'#password',
  data :{
    isValid:'',
    correct:'',
    password:{'current_password':'','new_password':''}
  },
  methods: {
    checkPassword:function(){
      this.isValid=window.password;
      if(this.isValid){
        this.$http.post('/api/settings/checkPassword',this.password).then((response) => {
          correct=response.data.data;
          console.log(correct);
          if(correct){
            this.changePassword()
          }
          else{
            swal("Invalid Current Password","Please Enter Correct Current Password", "error"); 
          }
        });
      }
    },
    changePassword: function() {
      var input = this.password;
      var ini=this;
        swal({
              title: "Are You Sure?",
              text: "You Will Change Your Password",
              type: "info",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes",
              closeOnConfirm: false
            },
            function(isConfirm){
              if(isConfirm){
                ini.$http.post('/api/settings/changePassword',input).then((response) => {

                });
                swal("Success","Your Password Has Been Changed", "success");              
              }             
      });     
    },
  }
});