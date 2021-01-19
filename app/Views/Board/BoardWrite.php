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
        <v-app>
          <v-app-bar app> 새 게시글 </v-app-bar>
          <v-content>
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
                <v-row align="center">
                  <v-col
                    cols="12"
                    sm="6">
                    <v-btn 
                    outlined color="blue" 
                    type="submit"
                    @click="listClick"> 
                      등록 
                    </v-btn> 
                    <v-btn outlined color="blue" @click="listClick"> 목록 </v-btn> 
                  </v-col>
                </v-row> 
              </v-container> 
            </v-form> 
          </v-content>
        </v-app>
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
       methods: {
        sendPost() {
          var postData = new FormData();
          postData.append('title', this.title);
          postData.append('name', this.name);
          postData.append('comment', this.comment);
          axios.post('http://localhost/index.php/boarddb/create', postData)
          .then((respose) => {
            console.log(res.data)
          })
          .catch ((error) => {
            console.log(error)
          })
        },
        listClick() {
         location.href = '../' 
        }
      }, 
      data() {
        return {
         title : '', 
         name : '',
         comment: '',
        } 
      }
  })
  </script>
</body>
</html>
