<iframe id="result" srcdoc="

  <link rel='stylesheet' href='table_viu.css'>
  <link rel='stylesheet' href='table_viu_font.css'>
  <link rel='stylesheet' href='table.css'>


  <div id=&quot;app&quot;>
    <v-app id=&quot;inspire&quot;>
      <v-toolbar dark color=&quot;primary&quot; fixed>
        <v-toolbar-title class=&quot;white--text&quot;>Nutrition</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-text-field v-model=&quot;search&quot; append-icon=&quot;search&quot; label=&quot;Search&quot; single-line hide-details></v-text-field>
        <v-menu offset-y :nudge-left=&quot;170&quot; :close-on-content-click=&quot;false&quot;>
            <v-btn icon slot=&quot;activator&quot;>
                <v-icon>more_vert</v-icon>
              </v-btn>
            <v-list>
              <v-list-tile  v-for=&quot;(item, index) in headers&quot;  :key=&quot;item.value&quot;   @click=&quot;changeSort(item.value)&quot;>
                <v-list-tile-title>{{ item.text }}<v-icon v-if=&quot;pagination.sortBy === item.value&quot;>{{pagination.descending ? 'arrow_downward':'arrow_upward'}}</v-icon></v-list-tile-title>
              </v-list-tile>
            </v-list>
          </v-menu>
      </v-toolbar>
          <v-layout v-resize=&quot;onResize&quot; column style=&quot;padding-top:56px&quot;>
            <v-data-table :headers=&quot;headers&quot; :items=&quot;desserts&quot; :search=&quot;search&quot; :pagination.sync=&quot;pagination&quot; :hide-headers=&quot;isMobile&quot; :class=&quot;{mobile: isMobile}&quot;>
              <template slot=&quot;items&quot; slot-scope=&quot;props&quot;>
                <tr v-if=&quot;!isMobile&quot;>
                  <td>{{ props.item.sr }}</td>
                  <td>{{ props.item.name }}</td>
                  <td class=&quot;text-xs-right&quot;>{{ props.item.calories }}</td>
                  <td class=&quot;text-xs-right&quot;>{{ props.item.fat }}</td>
                  <td class=&quot;text-xs-right&quot;>{{ props.item.carbs }}</td>
                  <td class=&quot;text-xs-right&quot;>{{ props.item.protein }}</td>
                  <td class=&quot;text-xs-right&quot;>{{ props.item.iron }}</td>
                </tr>
                <tr v-else>
                  <td>
                    <ul class=&quot;flex-content&quot;>
                      <li class=&quot;flex-item&quot; data-label=&quot;sr&quot;>{{ props.item.sr }}</li>
                      <li class=&quot;flex-item&quot; data-label=&quot;Name&quot;>{{ props.item.name }}</li>
                      <li class=&quot;flex-item&quot; data-label=&quot;Calories&quot;>{{ props.item.calories }}</li>
                      <li class=&quot;flex-item&quot; data-label=&quot;Fat (g)&quot;>{{ props.item.fat }}</li>
                      <li class=&quot;flex-item&quot; data-label=&quot;Carbs (g)&quot;>{{ props.item.carbs }}</li>
                      <li class=&quot;flex-item&quot; data-label=&quot;Protein (g)&quot;>{{ props.item.protein }}</li>
                      <li class=&quot;flex-item&quot; data-label=&quot;Iron (%)&quot;>{{ props.item.iron }}</li>
                    </ul>
                  </td>
                </tr>
              </template>
              <v-alert slot=&quot;no-results&quot; :value=&quot;true&quot; color=&quot;error&quot; icon=&quot;warning&quot;>
                Your search for &quot;{{ search }}&quot; found no results.
              </v-alert>
            </v-data-table>
          </v-layout>
    </v-app>
  </div>

<script src='table_viu.js'></script>
<script src='table_viu.min.js'></script>
<script src='table.js'></script>


" sandbox="allow-downloads allow-forms allow-modals allow-pointer-lock allow-popups allow-presentation  allow-scripts allow-top-navigation-by-user-activation" allow="camera; geolocation; microphone" allowtransparency="true" allowpaymentrequest="true" allowfullscreen="true" class="result-iframe" style="height: 100%;width: 100%;">
</iframe>