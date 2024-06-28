import './bootstrap';
import '~resources/scss/app.scss';
import '~icons/bootstrap-icons.scss';
import * as bootstrap from 'bootstrap';
import DataTable from 'datatables.net-dt';
import.meta.glob([
    '../img/**'
])

if (document.getElementById('cover_image') != null) {
    document.getElementById('cover_image').addEventListener('change', function () {
        let file = this.files[0];
        document.getElementById('preview-image').src = URL.createObjectURL(file);
    })
}

// DATA TABLE ROOM
let table_rooms = new DataTable('#table-rooms', {
    responsive: true,
    language: {
        url: '/it-IT.json',
    },
    "columns": [
        {
            "sortable": true
        },
        {
            "sortable": true
        },
        {
            "sortable": true
        },
        {
            "sortable": true
        },
        {
            "sortable": false
        },
        {
            "sortable": false
        },
    ]
});

// DATA TABLE EVENTS
let table_events = new DataTable('#table-events', {
    responsive: true,
    language: {
        url: '/it-IT.json',
    },
    "columns": [
        {
            "sortable": true
        },
        {
            "sortable": true
        },
        {
            "sortable": true
        },
        {
            "sortable": true
        },
        {
            "sortable": true
        },
        {
            "sortable": true
        },
        {
            "sortable": false
        },
        {
            "sortable": true
        },
        {
            "sortable": false
        },
    ]
});