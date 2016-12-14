Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");

new Vue({
  el :'#deploy_changes',
  data :{
    version: '',
  },
  ready: function() {
    this.getVersion();
  },
  methods: {
    deploy:function (){
      var ini=this;
            swal({
              title: "Are You Sure?",
              text: "You Will Deploy Changes To User Applications",
              type: "info",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes",
              closeOnConfirm: false
            },
            function(isConfirm){
              if(isConfirm){
                ini.$http.get('/api/manage/deploy').then((response) => {
                  ini.$set('version', response.data.version);
                   });
                swal("Success","Save Changes Success! ", "success");       
              }             
      });

    },
    getVersion:function(){
      this.$http.get('/api/manage/config').then((response) => {
        this.$set('version', response.data.version);
      });
    }
  }
});