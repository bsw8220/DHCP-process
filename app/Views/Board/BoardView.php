<!doctype html>
<html>
<head>
    <title>인턴 과제 게시판(백승우)</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
    <link href="/js/BoardView.js" rel="preload" as="script">
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
</head>
<body>
  <div id="app"> 
    <div data-app>
      <template>
        <v-app-bar> {{ title }} </v-app-bar>
        <v-form>
          <v-container>
            <div class="vwriter">
              <v-col
                cols="12"
                md="4">
                <v-banner>
                  작성자
                </v-banner>
              </v-col>
              <v-col
                cols="12"
                md="6">
                 {{ name }}
              </v-col>
              <v-spacer></v-spacer> 
            </div>
            <div class="vcomment">
              <v-col
                cols="12"
                md="4">
                <v-banner>
                  내용 
                </v-banner>
              </v-col>
              <v-col
                cols="12"
                md="4">
                {{ comment }} 
              </v-col> 
            </div>
            <v-row align="center">
              <v-col
                cols="12"
                sm="6">
              <v-btn outlined color="blue" @click="listClick"> 목록 </v-btn>
              <v-btn outlined color="blue" @click="delClick"> 삭제 </v-btn>  
              <v-btn outlined color="blue" @click="editClick"> 수정 </v-btn>
              </v-col>
            </v-row> 
          </v-container> 
        </v-form> 
      </template> 
    </div>
  </div>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
  <script>
    new Vue({
      el: '#app',
        vuetify: new Vuetify(),
        data() {
          return{
            id: location.search,
            title : '', 
            name : '',
            comment: ''
            } 
          }, 
        created() {
          this.fetch() 
        }, 
        methods: {
          fetch() {
            const data = location.pathname.split('/');
            const id = data[data.length-1];
            axios.get(`http://localhost/index.php/Boarddb/eachdata/${id}`) 
            .then((response) => {
              console.log(response)
              this.title = response.data.title
              this.name = response.data.name
              this.comment = response.data.comment
            }) 
            .catch((error) => {
              console.log(error) 
            }) 
          }, 
          listClick() {
            location.href = '../'
          },
          delClick() {
            const data = location.pathname.split('/');
            const id = data[data.length-1];
            axios.delete(`http://localhost/index.php/Boarddb/deletedata/${id}`) 
            .then((response) => {
              console.log(response)
              location.href = '../'
            }) 
            .catch((error) => {
              console.log(error) 
            }) 
          },
          editClick(item) {
            const data = location.pathname.split('/');
            const id = data[data.length-1];
            location.href = `http://localhost/index.php/home/upData/${id}`
          }, 
        }, 
    })
  </script>
</body>
</html>


