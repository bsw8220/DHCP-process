<!doctype html>
<html>
<head>
    <title>인턴 과제 가계부(백승우)</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
</head>
<body>
  <div id="app"> 
  <template>
    <v-app>
    <div data-app>
  <v-row 
  class="fill-height" 
  style="maxWidth: 700px; margin: auto;"
  align-center
  justify-center>
    <v-col>
      <v-sheet height="64">
        <v-toolbar
          flat
        >
          <v-col>
            <v-btn outlined color="blue" @click="boardClick">Board</v-btn>
          </v-col>
          <v-btn
            outlined
            class="mr-4"
            color="grey darken-2"
            @click="setToday"
          >
            Today
          </v-btn>
          <v-btn
            fab
            text
            small
            color="grey darken-2"
            @click="prev"
          >
            <v-icon small>
              mdi-chevron-left
            </v-icon>
          </v-btn>
          <v-btn
            fab
            text
            small
            color="grey darken-2"
            @click="next"
          >
            <v-icon small>
              mdi-chevron-right
            </v-icon>
          </v-btn>
          <v-toolbar-title v-if="$refs.calendar">
            {{ $refs.calendar.title }}
          </v-toolbar-title>
          <v-spacer></v-spacer>
          <v-btn 
          icon
          @click="createClick">
            <v-icon>mdi-calendar-plus</v-icon>
          </v-btn>
          <v-menu
            bottom
            right
          >
            <template v-slot:activator="{ on, attrs }">
              <v-btn
                outlined
                color="grey darken-2"
                v-bind="attrs"
                v-on="on"
              >
                <span>{{ typeToLabel[type] }}</span>
                <v-icon right>
                  mdi-menu-down
                </v-icon>
              </v-btn>
            </template>
            <v-list>
              <v-list-item @click="type = 'day'">
                <v-list-item-title>Day</v-list-item-title>
              </v-list-item>
              <v-list-item @click="type = 'week'">
                <v-list-item-title>Week</v-list-item-title>
              </v-list-item>
              <v-list-item @click="type = 'month'">
                <v-list-item-title>Month</v-list-item-title>
              </v-list-item>
              <v-list-item @click="type = '4day'">
                <v-list-item-title>4 days</v-list-item-title>
              </v-list-item>
            </v-list>
          </v-menu>
        </v-toolbar>
      </v-sheet>
      <v-sheet height="600">
        <v-calendar
          ref="calendar"
          v-model="focus"
          color="primary"
          :events="events"
          :event-color="getEventColor"
          :type="type"
          @click:event="showEvent"
          @click:more="viewDay"
          @click:date="viewDay"
          @change="updateRange"
        ></v-calendar>
        <v-menu
          v-model="selectedOpen"
          :close-on-content-click="false"
          :activator="selectedElement"
          offset-x
        >
          <v-card
            color="grey lighten-4"
            min-width="350px"
            flat
          >
            <v-toolbar
              :color="selectedEvent.color"
              dark
            >
              <v-toolbar-title class="ma-8" v-html="selectedEvent.memo"></v-toolbar-title>
              <v-spacer></v-spacer>
              <v-btn 
              icon
              @click.native="overlay=!overlay">
                <v-icon>mdi-calendar-remove</v-icon>
              </v-btn>
              <v-btn 
              icon
              @click="editClick">
                <v-icon>mdi-calendar-edit</v-icon>
              </v-btn>
            </v-toolbar>
            <v-card-text>
              <span v-html="selectedEvent.hour"></span>
              <span>시</span>
              <span v-html="selectedEvent.minute"></span>
              <span>분</span><br>
              <span v-html="selectedEvent.type_info"></span>
              <span v-html="selectedEvent.credit"></span>
              <span> 원</span>
            </v-card-text>
            <v-card-actions>
              <v-btn
                text
                color="secondary"
                @click="selectedOpen = false"
              >
                Cancel
              </v-btn>
            </v-card-actions>
            </v-card>
          </v-menu>
          <v-overlay
            :z-index="zIndex"
            :value="overlay">
            <v-card>
              <v-toolbar flat justify="center">
                정말 삭제하시겠습니까?
              </v-toolbar>
              <v-row>
                <v-btn 
                class="ma-2"
                color="error"
                plain 
                @click="delClick(selectedEvent.id)">삭제</v-btn>
                <v-spacer></v-spacer>
                <v-btn 
                class="ma-2"
                color="grey"
                plain 
                @click.native="overlay=false">아니오</v-btn>
              </v-row>
            </v-card>
          </v-overlay>
          <v-toolbar flat>
            <span>월 지출액 : {{ total_out() }}원</span>
            <v-spacer></v-spacer>
            <span>월 소득액 : {{ total_in() }}원</span>
          </v-toolbar>
          <v-toolbar flat>
            <v-spacer></v-spacer>
            <span>이달 총 소득 : {{ total_in() - total_out() }}원</span>
          </v-toolbar>
        </v-sheet>
      </v-col>
    </v-row>
  </div>
  </v-app>
  </template>
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
                overlay: false,
                zIndex: 0,
                memo: '',
                type_info: '',
                credit: '',
                dates: new Date().toISOString().substr(0, 10),
                hour: '',
                minute: '',
                focus: '',
                type: 'month',
                typeToLabel: {
                  month: 'Month',
                  week: 'Week',
                  day: 'Day',
                  '4day': '4 Days',
                },
                selectedEvent: {},
                selectedElement: null,
                selectedOpen: false,
                events: [],
                colors: ['blue', 'indigo', 'deep-purple', 'cyan', 'green', 'orange', 'grey darken-1'],
              }),
              mounted () {
                this.$refs.calendar.checkChange()
              },
              methods: {
                viewDay ({ date }) {
                  this.focus = date
                  this.type = 'day'
                },
                getEventColor (event) {
                  return event.color
                },
                setToday () {
                  this.focus = ''
                },
                prev () {
                  this.$refs.calendar.prev()
                },
                next () {
                  this.$refs.calendar.next()
                },
                showEvent ({ nativeEvent, event }) {
                  this.currentid = event.id;
                  const open = () => {
                    this.selectedEvent = event
                    this.selectedElement = nativeEvent.target
                    setTimeout(() => {
                      this.selectedOpen = true
                    }, 10)
                  }

                  if (this.selectedOpen) {
                    this.selectedOpen = false
                    setTimeout(open, 10)
                  } else {
                    open()
                  }

                  nativeEvent.stopPropagation()
                },
                updateRange ({ start, end }) { 
                  axios.get('http://localhost/index.php/calendardb') // Get은 배열로 가져오므로 0부터 콘솔로그를 찍어서 오류난 지점을 찾아본다.
                  .then((response) => {
                    const events = []
                    response.data.forEach(item =>{
                    events.push({
                      id: item.id,
                      start: item.dates+' '+item.hour+':'+item.minute+':00',
                      end: item.dates+' '+item.hour+':'+item.minute+':00',
                      memo: item.memo,
                      type_info: item.type_info,
                      credit: item.credit,
                      hour: item.hour,
                      minute: item.minute,
                      color: this.colors[this.rnd(0, this.colors.length - 1)],
                    })
                    this.events = events
                  })
                  })
                  .catch((error) => {
                    console.log(error)
                  })
                  // const min = new Date(`${start.date}T00:00:00`)
                  // const max = new Date(`${end.date}T23:59:59`)
                },
                rnd (a, b) {
                  return Math.floor((b - a + 1) * Math.random()) + a
                },
                delClick(id) {
                  axios.delete(`http://localhost/index.php/calendardb/deletedata/${id}`) 
                  .then((response) => {
                    console.log(response)
                    location.reload();
                  }) 
                  .catch((error) => {
                    console.log(error) 
                  }) 
                },
                boardClick() {
                  location.href = 'http://localhost/index.php/home' 
                },
                createClick() {
                  location.href = 'http://localhost/index.php/home/calendarcreate' 
                },
                editClick(currentid) {
                  location.href = `http://localhost/index.php/home/calendaredit/${this.currentid}` 
                },
                total_in() {
                  var total = 0;
                  this.events.forEach(item => {
                    if(item.type_info == "수입"){
                      total += Number(item.credit);
                    }
                  });
                  return total;
                },
                total_out() {
                  var total = 0;
                  this.events.forEach(item => {
                    if(item.type_info == "지출"){
                      total += Number(item.credit);
                    }
                  });
                  return total;
                },
              },
            })
</script>
</body>
</html>


