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
          @click:date="showEvent"
          @click:more="viewDay"
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
              <v-btn icon>
                <v-icon>mdi-pencil</v-icon>
              </v-btn>
              <v-toolbar-title v-html="selectedEvent.name"></v-toolbar-title>
              <v-spacer></v-spacer>
              <v-btn icon>
                <v-icon>mdi-heart</v-icon>
              </v-btn>
              <v-btn icon>
                <v-icon>mdi-dots-vertical</v-icon>
              </v-btn>
            </v-toolbar>
            <v-card-text>
              <span v-html="selectedEvent.details"></span>
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
                  const events = []

                  // const min = new Date(`${start.date}T00:00:00`)
                  // const max = new Date(`${end.date}T23:59:59`)
                  // const days = (max.getTime() - min.getTime()) / 86400000
                  // const eventCount = this.rnd(days, days + 20)

                  // for (let i = 0; i < eventCount; i++) {
                  //   const allDay = this.rnd(0, 3) === 0
                  //   const firstTimestamp = this.rnd(min.getEventColorime(), max.getTime())
                  //   const first = new Date(firstTimestamp - (firstTimestamp % 900000))
                  //   const secondTimestamp = this.rnd(2, allDay ? 288 : 8) * 900000
                  //   const second = new Date(first.getTime() + secondTimestamp)

                    // events.push({
                  //     name: this.names[this.rnd(0, this.names.length - 1)],
                  //     start: first,
                  //     end: second,
                      // color: this.colors[this.rnd(0, this.colors.length - 1)],
                  //     timed: !allDay,
                    // })
                  // }

                  this.events = events
                },
                rnd (a, b) {
                  return Math.floor((b - a + 1) * Math.random()) + a
                },
                boardClick() {
                  location.href = '../' 
                },
              },
            })
</script>
</body>
</html>


