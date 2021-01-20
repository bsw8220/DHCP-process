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
        <v-app>
          <v-app-bar app>
              {{ title }}
          </v-app-bar>
          <v-content>
            <v-form
            ref="form"
            v-model="valid">  
              <v-container style="maxWidth: 700px;">
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
                <v-toolbar flat>
                  <v-spacer></v-spacer>
                  <v-btn 
                  outlined color="blue" 
                  @click="listClick" 
                  class="botton ma-2"> 목록 </v-btn>
                  <v-btn 
                  outlined color="blue" 
                  @click.native="overlay=!overlay"
                  class="botton ma-2"> 삭제 </v-btn>  
                  <v-btn 
                  outlined color="blue" 
                  @click="editClick"
                  class="botton ma-2"> 수정 </v-btn>
                </v-toolbar>
                <v-overlay
                  :z-index="zIndex"
                  :value="overlay">
                  <v-card>
                    <v-toolbar flat justify="center">
                      정말 삭제하시겠습니까?
                    </v-toolbar>
                    <v-text-field
                    class="ma-2"
                    :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                    :rules="[rules.required, rules.min]"
                    :type="show ? 'text' : 'password'"
                    name="input-10-1"
                    label="비밀번호"
                    counter
                    @click:append="show = !show"
                    ></v-text-field> 
                    <v-row>
                      <v-btn 
                      class="ma-2"
                      :disabled="!valid"
                      color="error"
                      plain 
                      @click="delClick">삭제</v-btn>
                      <v-spacer></v-spacer>
                      <v-btn 
                      class="ma-2"
                      color="grey"
                      plain 
                      @click.native="overlay=false">아니오</v-btn>
                    </v-row>
                  </v-card>
                </v-overlay>
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
        data: {
          valid: false,
          overlay: false,
          zIndex: 0,
          show: false,
          id: location.search,
          title: '', 
          name: '',
          comment: '',
          pass:'',
          rules: {
            required: value => !!value || '필수 사항',
            min: v => v.length >= 8 || '최소 8자 이상 입니다.',
            match: v => (!!v && this.pass) || '패스워드가 일치하지 않습니다.',
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
              this.title = response.data.title
              this.name = response.data.name
              this.comment = response.data.comment
              this.pass = response.data.pass
            }) 
            .catch((error) => {
              console.log(error) 
            }) 
          }, 
          listClick() {
            location.href = 'http://localhost/index.php/home'
          },
          delClick() {
            const data = location.pathname.split('/');
            const id = data[data.length-1];
            axios.delete(`http://localhost/index.php/Boarddb/deletedata/${id}`) 
            .then((response) => {
              console.log(response)
              location.href = 'http://localhost/index.php/home'
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


