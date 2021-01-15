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
    <div data-app>
      <template>
        <v-app-bar> 수정 </v-app-bar>
        <v-form
          @submit.prevent="sendPost">
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
              >
                {{ title }} 
              </v-text-field> 
            </v-row> 
            <v-row>
              <v-text-field 
                :counter="50" 
                label="작성자" 
                name="name" 
                required 
                v-model="name" 
                maxlength="50" 
              > 
                {{ name }}
              </v-text-field> 
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
              > 
                {{ comment }} 
              </v-textarea> 
            </v-row> 
            <v-row align="center">
              <v-col
                cols="12"
                sm="6">
                <v-btn 
                outlined color="blue" 
                type="submit"
                @click="listClick"> 
                  수정 
                </v-btn> 
                <v-btn outlined color="blue" @click="listClick"> 목록 </v-btn> 
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
        return {
         id : location.search,
         title : '', 
         name : '',
         comment: '', 
        } 
      },
      created() {
            this.fetch() 
      }, 
      methods: {
        fetch() {
          const data = location.pathname.split('/');
          console.log(data);
          const id = data[data.length-1];
          console.log(id);
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
        sendPost: function () {
          var postData = new FormData();  
            postData.append('title', this.title);
            postData.append('name', this.name);
            postData.append('comment', this.comment);
            axios.post('http://localhost/index.php/boarddb/editData', postData)
            .then(function(res) {
              console.log(res.data)
            }, function() {
              console.log('failed')
          })
        },
        listClick() {
          location.href = '../' 
        }
      }, 
    })
  </script>
</body>
</html>
