<!doctype html>
<html>
<head>
    <title>인턴 과제 게시판(백승우)</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
</head>
<body>
  <div id="app"> 
  <template>
    <div data-app>
     <v-container> 
     <v-data-table
      :headers="headers"
      :items="desserts" 
      :items-per-page="5" 
      class="elevation-1" 
     > 
     </v-data-table> 
     <v-row>
      <v-btn outlined color="blue" @click="writeClick" > 작성 </v-btn> 
      </v-row> 
     </v-container> 
   </div>
  </template>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://unpkg.com/vue-router/dist/vue-router.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="/js/main.js"></script>
  <script src="/js/route.js"></script>
  <script>
    // const router = VueRouter()
    new Vue({
      el: '#app',
      vuetify: new Vuetify(),
      router: new VueRouter(),
      name: 'BoardList',
      created() {
        this.fetch() 
      }, 
      methods: {
        fetch() {
          console.log('fetch list') 
          axios.get('http://localhost/index.php/Boarddb/list') 
          .then((response) => {
          console.log(response) 
          this.desserts=response.results
          }) 
          .catch((error) => {
          console.log(error)
          }) 
        },
        writeClick() {
         // this.$router.push('./index.php/home/write')
         location.href = './index.php/home/write' 
        },
      }, 
      data() {
          return{
            headers: [
              {
                text: 'Number', 
                align: 'left', 
                sortable: false, 
                value: 'id', 
              }, 
              {
                text: 'Title', 
                value: 'title' 
              }, 
              {
                text : 'Name',
                value : 'name'
              },
              {
                text: 'Reg Date', 
                value: 'wdate' 
              }
            ], 
            desserts: [], 
          }
        }  
    })
  </script>
</body>
</html>