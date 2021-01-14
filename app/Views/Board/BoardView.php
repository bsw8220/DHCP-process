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
  <template>
   <v-form>
    <v-container>
     <v-row>
      제목 
     </v-row> 
     <v-row>
      {{ title }} 
     </v-row> 
     <v-row>
      내용 
     </v-row> 
     <v-row>
      {{ context }} 
     </v-row> 
     <v-row>
      <v-btn block outlined color="blue" @click="listClick"> 목록 </v-btn> 
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
  <script src="/js/BoardView.js"></script>
</body>
</html>


