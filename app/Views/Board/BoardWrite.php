<!doctype html>
<html>
<head>
    <title>인턴 과제 게시판(백승우)</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
</head>
<body>
  <div id="app"> 
  <template>
   <v-form>
    <v-container>
     <v-row>
      제목 
     </v-row> 
     <v-row>
      <v-text-field 
       :counter="50" 
       label="제목" 
       name="title" 
       required 
       v-model="title" 
       maxlength="50" 
      ></v-text-field> 
     </v-row> 
     <v-row>
      <v-text-field 
       :counter="50" 
       label="작성자" 
       name="name" 
       required 
       v-model="name" 
       maxlength="50" 
      ></v-text-field> 
     </v-row> 
     <v-row>
      내용 
     </v-row> 
     <v-row>
      <v-textarea
       filled 
       name="comment" 
       hint="내용을 입력해주세요." 
       v-model="comment" 
       :counter="1000" 
       maxlength="1000" 
      ></v-textarea> 
     </v-row> 
     <v-row>
      <v-btn outlined color="blue" @click="writeClick"> 등록 </v-btn> 
      <v-btn outlined color="blue" @click="listClick"> 목록 </v-btn> 
     </v-row> 
    </v-container> 
   </v-form> 
  </template> 
  </div>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://unpkg.com/vue-router/dist/vue-router.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
  <script>
    // var router = new VueRouter({
    //   routes: [ 
    //     { path: '/', 
    //     name: 'BoardList', 
    //     component: BoardList 
    //   } ]
    // })
    new Vue({
      el: '#app',
      vuetify: new Vuetify(),
      name: 'BoardWrite', 
       methods: {
        writeClick() {
         // if(this.$route.params.seq) {
         //  axios.put('http://localhost/index.php/Boarddb', this.$data) 
         //  .then((response) => {
         //   console.log(response) 
         //   this.$router.push('/') 
         //  }) 
         //  .catch((error) => {
         //   console.log(error) 
         //  }) 
         // } 
         // else {
          this.$data.wdate = this.getNowDate() 
          // this.$data.uptDt = this.getNowDate() 
          axios.post('http://localhost/index.php/Boarddb/insert', this.$data) 
          .then((response) => {
           console.log(response) 
           // this.$router.push('/') 
          }) 
          .catch((error) => {
           console.log(error) 
          }) 
         // } 
        },
        listClick() {
         location.href = '../' 
        },
        getNowDate() {
         var nowDate = new Date() 
         var year = nowDate.getFullYear().toString() 
         var month = (nowDate.getMonth() + 1).toString() 
         var day = nowDate.getDate().toString() 

         return year + "-" + (month[1] ? month : "0" + month[0]) + "-" + (day[1] ? day : "0" + day[0]) 
        } 
       }, 
       data() {
        return {
         title : '', 
         name : '',
         comment: '', 
         wdate: '', 
        } 
       }
      })
  </script>
</body>
</html>
