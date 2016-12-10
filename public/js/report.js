Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");

new Vue({
  el :'#viewreport',
  data :{
    orders: [],
    period:{'from':'','to':''},
    total:'',
    first:'',
    last:'',
    pagination: {
      total: 0,
      per_page: 2,
      from: 1,
      to: 0,
      current_page: 1
    },
    offset: 4,
    formErrors:{},
    formErrorsUpdate:{},
  },
    
  computed: {
    isActived: function() {
      return this.pagination.current_page;
    },
    pagesNumber: function() {
      if (!this.pagination.to) {
        return [];
      }
      var from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }
      var to = from + (this.offset * 2);
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }
      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    },
  },
  ready: function() {
    this.getInitial();
  },
  methods: {
    getVueItems: function(page) {
      this.$http.post('/api/report?page='+page,this.period).then((response) => {
        this.$set('orders', response.data.data.data);
        this.$set('pagination', response.data.pagination);
        this.$set('total',response.data.total);      
      });
    },
    getInitial: function(){
      this.$http.get('/api/report').then((response) => {
        this.period.from=response.data.first;
        this.period.to=response.data.last;
        this.first=this.period.from;
        this.last=this.period.to;
        this.getVueItems(this.pagination.current_page);
      });
    },
    changePage: function(page) {
      this.pagination.current_page = page;
      this.getVueItems(page);
    }
  }
});