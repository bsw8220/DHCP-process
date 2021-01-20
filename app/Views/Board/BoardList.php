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
      <v-app>
        <div data-app>
          <v-app-bar app>
           게시판 과제
           <v-spacer></v-spacer>
           <v-btn outlined color="blue" @click="calendarClick">Calendar</v-btn>
          </v-app-bar>
          <v-content>
            <v-container
              fluid :grid-list-md="!$vuetify.breakpoint.xs" :class="$vuetify.breakpoint.xs ? 'pa-0' : ''" style="maxWidth: 700px;"> 
              <v-data-table
                class="pa-md-20 mx-lg-auto text-center"
                :headers="headers"
                :items="desserts" 
                :items-per-page="10" 
                class="elevation-1" 
                @click:row="rowClick"
              > 
              </v-data-table> 
              <v-toolbar flat>
                <v-spacer></v-spacer>
                <v-btn outlined color="blue" @click="writeClick" > 작성 </v-btn> 
              </v-toolbar> 
            </v-container> 
          </v-content>
        </div>
      </v-app>
    </template>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script>
    new Vue({
      el: '#app',
      vuetify: new Vuetify(),
      name: 'BoardList',
      created() {
        this.fetch() 
      }, 
      methods: {
        fetch() {
          console.log('fetch list') 
          axios.get('http://localhost/index.php/Boarddb') 
          .then((response) => {
            console.log(response) 
            this.desserts=response.data
          }) 
          .catch((error) => {
            console.log(error)
          }) 
        },
        calendarClick() {
          location.href = 'http://localhost/index.php/home/calendar' 
        },
        writeClick() {
          location.href = 'http://localhost/index.php/home/write' 
        },
        rowClick(item) {
          location.href = 'http://localhost/index.php/home/view/'+ item.id
        } 
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