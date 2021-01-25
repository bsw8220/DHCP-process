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
          <v-app-bar app> 수정 </v-app-bar>
          <v-main>
            <v-form
              @submit.prevent="sendPost"
              v-model="valid">
              <v-container style="maxWidth: 700px;">
                <v-row>
                  <v-input
                    label="글 번호" 
                    name="id" 
                    required 
                    v-model="id" 
                  >
                    {{ id }} 
                  </v-input> 
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
                  <v-textarea
                    filled 
                    label="내용"
                    name="comment" 
                    hint="내용을 입력해주세요." 
                    v-model="comment" 
                    :counter="1000" 
                    maxlength="1000" 
                  > 
                    {{ comment }} 
                  </v-textarea> 
                </v-row> 
                <v-toolbar flat class="ma-5">
                  <v-spacer></v-spacer>
                  <v-btn 
                  outlined color="blue" 
                  @click.native="overlay=!overlay"
                  class="mr-3"
                  > 
                    수정 
                  </v-btn> 
                  <v-btn outlined color="blue" @click="listClick"> 목록 </v-btn> 
                </v-toolbar>
                <v-overlay
                  :z-index="zIndex"
                  :value="overlay">
                  <v-card>
                    <v-toolbar flat justify="center">
                      비밀 번호를 입력해주세요.
                    </v-toolbar>
                    <v-text-field
                    class="ma-2"
                    :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                    :rules="[rules.required, rules.min]"
                    :type="show ? 'text' : 'password'"
                    name="input-10-1"
                    label="비밀번호"
                    v-model="pass"
                    counter
                    @click:append="show = !show"
                    ></v-text-field> 
                    <v-row>
                      <v-btn 
                      class="ma-2"
                      :disabled="!valid"
                      color="blue"
                      type="submit"
                      plain 
                      @click="listClick">수정</v-btn>
                      <v-spacer></v-spacer>
                      <v-btn 
                      class="ma-2"
                      color="grey"
                      plain 
                      @click.native="overlay=false">취소</v-btn>
                    </v-row>
                  </v-card>
                </v-overlay>
              </v-container> 
            </v-form> 
          </v-main>
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
      data: {
        valid: false,
        overlay: false,
        zIndex: 0,
        show: false,
        id: location.search,
        title: '', 
        name: '',
        comment: '', 
        pass: '',
        rules: {
          required: value => !!value || '필수 입력 사항',
          min: v => v.length >= 8 || '최소 8자 이상 입니다.',
        },
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
            this.id = response.data.id
            this.title = response.data.title
            this.name = response.data.name
            this.comment = response.data.comment
          }) 
          .catch((error) => {
            console.log(error) 
          }) 
        },
        sendPost() {
          var postData = new FormData();
          postData.append('id', this.id);
          postData.append('title', this.title);
          postData.append('name', this.name);
          postData.append('comment', this.comment);
          postData.append('pass',this.pass);
          axios.post('http://localhost/index.php/boarddb/editdata', postData)
          .then((response) => {
            console.log(response.data)
          }) 
          .catch ((error) => {
            console.log(error)
            alert("비밀번호가 일치하지 않습니다.");
          })
        },
        listClick() {
          location.href = 'http://localhost/index.php/home'
        }
      }
    })
  </script>
</body>
</html>
