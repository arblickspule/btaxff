

    <div v-scope id="statement" @vue:mounted="mounted()">
        <div>
            <select v-model="driverSelected" @change="reloadData()">
                <option v-for="listitem in driverList">{{ listitem.name }}</option>
            </select>
            <select @change="reloadData()">
                <!-- <option v-for="listitem in weekList">{{ listitem.name }}</option> -->
            </select>
        </div>
        <div class="container-fluid">
            <table>
                <tr>
                    <th v-for="header in dbFields">{{ header }}</th>
                </tr>
                <tr v-for="row in data">
                    <td v-for="cell in row">{{ cell }}</td>
                </tr>
            </table>
        </div>
    </div>

<script type="module">
  import { createApp } from 'https://unpkg.com/petite-vue?module'
//   import _ fro 'lodash'


  createApp({
    driverList: [],
    driverSelected: '',
    dbFields: ['BookingID','RequestedPickupTime','PickupAddress','DropoffAddress','Cost','Type','DropoffFee','ParkingFee','WaitingFee','OtherFee','OtherDescription'],
    startDate: '2022/09/01 00:00:00',
    endDate: '2022/09/09 00:00:00',
    data: [],
    async mounted() {
        axios({
            url: 'http://localhost:8055/items/drivers',
            headers: {
                'authorization': 'Bearer c9zSw_CDZXw9TBM07Y-oiSrPp_YXjwQB',
            },
            method: 'get',
        }).then( response => {
            console.log(response.data.data)
            this.driverList = response.data.data
        })

    },
    reloadData() {
        console.log(this.driverSelected)
        axios({
            url: 'http://localhost:8055/items/bookings',
            headers: {
                'authorization': 'Bearer c9zSw_CDZXw9TBM07Y-oiSrPp_YXjwQB',
            },
            params: {
                'fields': this.dbFields.join(','),
                'filter[DriverDetails][_eq]': this.driverSelected,
                'filter[RequestedPickupTime][_between]': this.startDate + ', ' + this.endDate,
                // 'filter[RequestedPickupTime][_lt]': this.endDate,
            },
            method: 'get',
        }).then( response => {
            console.log(response.data.data)
            this.data = response.data.data
        })
    }
  }).mount('#statement')
</script>