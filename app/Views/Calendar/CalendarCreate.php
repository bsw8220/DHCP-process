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
          <v-app-bar app> New </v-app-bar>
          <v-content>
            <v-form
              @submit.prevent="sendPost"
              ref="form"
              v-model="valid">
              <v-container style="maxWidth: 700px;">
                <v-row>
                  <v-text-field 
                  :counter="50" 
                  label="Memo" 
                  name="memo" 
                  required 
                  v-model="memo" 
                  maxlength="50" 
                  ></v-text-field> 
                </v-row> 
                <v-select
                style="max-width:100px;"
                :items="['수입','지출']"
                v-model="type_info"
                >
                  <template v-slot:item="{ item, attrs, on }">
                    <v-list-item
                    v-bind="attrs"
                    v-on="on">
                      <v-list-item-title
                      :id="attrs['aria-labelledby']"
                      v-text="item"
                      ></v-list-item-title>
                    </v-list-item>
                  </template>
                </v-select>
                <v-text-field
                :counter="50" 
                label="금액" 
                name="credit" 
                required 
                v-model="credit" 
                maxlength="50"></v-text-field>
                <v-row>
                  <v-col>
                <template>
                  <v-row justify="center">
                    <v-date-picker v-model="dates"></v-date-picker>
                  </v-row>
                </template>
              </v-col>
              <v-col>
                <v-toolbar flat class="pt-10 pb-10">
                  <v-spacer></v-spacer>
                    <v-select
                    style="max-width:100px;"
                    :items="['00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23']"
                    label="시"
                    v-model="hour"
                    >
                      <template v-slot:item="{ item, attrs, on }">
                        <v-list-item
                        v-bind="attrs"
                        v-on="on">
                          <v-list-item-title
                          :id="attrs['aria-labelledby']"
                          v-text="item"
                          ></v-list-item-title>
                        </v-list-item>
                      </template>
                    </v-select>시
                    <v-select
                    style="max-width:100px;"
                    class="ml-3 mr-3"
                    :items="['00','05','10','15','20','25','30','35','40','45','50','55']"
                    label="분"
                    v-model="minute"
                    >
                      <template v-slot:item="{ item, attrs, on }">
                        <v-list-item
                        v-bind="attrs"
                        v-on="on">
                          <v-list-item-title
                          :id="attrs['aria-labelledby']"
                          v-text="item"
                          ></v-list-item-title>
                        </v-list-item>
                      </template>
                    </v-select>분
                  </v-toolbar> 
                </v-col>
              </v-row>
                <v-toolbar class="mt-10" flat align="center">
                  <v-spacer></v-spacer>
                  <v-btn 
                  class="mr-3"
                  :disabled="!valid"
                  outlined color="blue" 
                  type="submit"
                  @click="returnClick"> 
                    등록 
                  </v-btn> 
                  <v-btn outlined color="blue" @click="returnClick"> 돌아가기 </v-btn> 
                </v-toolbar> 
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
        data: () => ({
            valid: false,
            memo: '',
            type_info: '', 
            credit: '',
            dates: '',
            hour: '',
            minute: '',
            // item:[
            //   {title: 'null'},
            //   {title: '수입'},
            //   {title: '지출'},
            // ],
        }), 
       methods: {
        sendPost() {
          var postData = new FormData();
          postData.append('memo', this.memo);
          postData.append('type_info', this.type_info);
          postData.append('credit', this.credit);
          postData.append('dates', this.dates);
          postData.append('hour', this.hour);
          postData.append('minute', this.minute);
          axios.post('http://localhost/index.php/calendardb/create', postData)
          .then((response) => {
            console.log(response.data)
          })
          .catch ((error) => {
            console.log(error)
          })
        },
        returnClick() {
         location.href = 'http://localhost/index.php/home/calendar' 
        },
      }, 
      
  })
  </script>
</body>
</html>
