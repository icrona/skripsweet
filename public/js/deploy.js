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
      this.$http.get('/api/manage/deploy').then((response) => {
        this.$set('version', response.data.version);
      });
    },
    getVersion:function(){
      this.$http.get('/api/manage/config').then((response) => {
        this.$set('version', response.data.version);
      });
    }
  }
});