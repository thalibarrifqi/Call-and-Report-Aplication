package com.example.ekybintarnow.bottomnavigationview;

import android.annotation.SuppressLint;
import android.app.Notification;
import android.app.PendingIntent;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
import android.os.Vibrator;
import android.view.MenuItem;
import android.view.View;
import androidx.annotation.NonNull;
import androidx.appcompat.app.ActionBarDrawerToggle;
import androidx.core.app.NotificationCompat;
import androidx.core.app.NotificationManagerCompat;
import androidx.core.view.GravityCompat;
import com.google.android.material.navigation.NavigationView;
import androidx.drawerlayout.widget.DrawerLayout;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;
import android.widget.AdapterView;
import android.widget.EditText;
import android.widget.ListAdapter;
import android.widget.ListView;
import android.widget.SimpleAdapter;
import android.widget.TextView;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import java.util.ArrayList;
import java.util.HashMap;

import static com.example.ekybintarnow.bottomnavigationview.App.CHANNEL_1_ID;
import static com.example.ekybintarnow.bottomnavigationview.App.CHANNEL_2_ID;
import static com.example.ekybintarnow.bottomnavigationview.Login.Username;

public class Home extends AppCompatActivity implements ListView.OnItemClickListener, NavigationView.OnNavigationItemSelectedListener {

    Vibrator vibrator;
    private EditText nama_teknisi, notifTeknisi, detailNotifTeknisi;
    private ListView listView;
    private String JSON_STRING;
    private NotificationManagerCompat notificationManager;
    private SwipeRefreshLayout swipeRefreshLayout;
    public TextView tulisanNIK, tulisanNama;
    int awal = 0;
    int akhir = 0;
    int first = 0;
    int last = 0;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);
        Toolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        final DrawerLayout drawer = findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(this, drawer, toolbar, R.string.drawerOpen, R.string.drawerClose);
        drawer.addDrawerListener(toggle);
        toggle.syncState();

        NavigationView navigationView = findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);
        View headerView = navigationView.getHeaderView(0);
        tulisanNIK = headerView.findViewById(R.id.cobaNIK);
        tulisanNama = headerView.findViewById(R.id.cobaNama);

        listView = findViewById(R.id.listView);
        listView.setOnItemClickListener(this);
        vibrator = (Vibrator)getSystemService(Context.VIBRATOR_SERVICE);

        notifTeknisi=findViewById(R.id.notivConveyor);
        detailNotifTeknisi=findViewById(R.id.detailNotifConveyor);

        nama_teknisi=findViewById(R.id.teknisi);

        SharedPreferences pref = getSharedPreferences("loginData", MODE_PRIVATE);
        String teknisi = pref.getString(Username,"");
        nama_teknisi.setText(teknisi);


//        Intent serviceIntent = new Intent(this, ForegroundService.class);
//        ContextCompat.startForegroundService(this, serviceIntent);
        startService(new Intent(getApplicationContext(), ForegroundService.class));

        notificationManager = NotificationManagerCompat.from(this);
        content();
        contentSelesai();
        getJSON();
        getDetail();
        swipeRefreshLayout =  findViewById(R.id.swipe_refresh);
        swipeRefreshLayout.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                getJSON();
                swipeRefreshLayout.setRefreshing(false);
            }
        });


    }

    public void content()
    {
        getNotif();
        refresh();
    }

    private void refresh()
    {
        final Handler handler = new Handler();
        final Runnable runnable = new Runnable() {
            @Override
            public void run() {
                content();
            }
        };
        handler.postDelayed(runnable, 1000);
    }

    //mengambil data
    public void getJSON(){
        @SuppressLint("StaticFieldLeak")
        class GetJSON extends AsyncTask<Void,Void,String> {

            private ProgressDialog loading;
            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                loading = ProgressDialog.show(Home.this,"Mengambil Data","Mohon Tunggu...",false,false);
            }

            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
                loading.dismiss();
                JSON_STRING = s;
                showData();
            }

            @Override
            protected String doInBackground(Void... params) {
                RequestHandler rh = new RequestHandler();
                return rh.sendGetRequest(konfigurasi.URL_GET_ALL);
            }
        }
        GetJSON gj = new GetJSON();
        gj.execute();
    }

    public void showData(){

        JSONObject jsonObject;
        ArrayList<HashMap<String,String>> list = new ArrayList<>();
        try {
            jsonObject = new JSONObject(JSON_STRING);
            JSONArray result = jsonObject.getJSONArray(konfigurasi.TAG_JSON_ARRAY);

            for(int i = 0; i<result.length(); i++){
                JSONObject jo = result.getJSONObject(i);
                String id = jo.getString(konfigurasi.TAG_ID);
                String conveyor = jo.getString(konfigurasi.TAG_CONVEYOR);
                String kerusakan = jo.getString(konfigurasi.TAG_KERUSAKAN);
                String keterangan = jo.getString(konfigurasi.TAG_KETERANGAN);
                String status = jo.getString(konfigurasi.TAG_STATUS);
                String start_date = jo.getString(konfigurasi.TAG_START_DATE);
                String nama_klik = jo.getString(konfigurasi.TAG_KLIK_TEKNISI);

                HashMap<String,String> employees = new HashMap<>();
                employees.put(konfigurasi.TAG_ID,id);
                employees.put(konfigurasi.TAG_CONVEYOR,conveyor);
                employees.put(konfigurasi.TAG_KERUSAKAN,kerusakan);
                employees.put(konfigurasi.TAG_KETERANGAN,keterangan);
                employees.put(konfigurasi.TAG_STATUS,status);
                employees.put(konfigurasi.TAG_START_DATE,start_date);
                employees.put(konfigurasi.TAG_KLIK_TEKNISI,nama_klik);
                list.add(employees);

            }

        } catch (JSONException e) {
            e.printStackTrace();
        }

        ListAdapter adapter = new SimpleAdapter(
                Home.this, list, R.layout.list_item,
                new String[]{konfigurasi.TAG_ID, konfigurasi.TAG_CONVEYOR,konfigurasi.TAG_KERUSAKAN,
                        konfigurasi.TAG_KETERANGAN,konfigurasi.TAG_STATUS,konfigurasi.TAG_START_DATE,
                        konfigurasi.TAG_KLIK_TEKNISI},
                new int[]{R.id.viewId, R.id.viewConveyor, R.id.viewKerusakan, R.id.viewKeterangan,
                        R.id.viewStatus, R.id.viewDate, R.id.viewNamaTeknisi});
        listView.setAdapter(adapter);

    }

    //mengambil data notif
    public void getNotif(){
        @SuppressLint("StaticFieldLeak")
        class GetJSON extends AsyncTask<Void,Void,String> {

            //ProgressDialog loading;
            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                //loading = ProgressDialog.show(Home.this,"Mengambil Data","Mohon Tunggu...",false,false);
            }

            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
                //loading.dismiss();
                JSON_STRING = s;
                showNotif(s);
            }

            @Override
            protected String doInBackground(Void... params) {
                RequestHandler rh = new RequestHandler();
                return rh.sendGetRequest(konfigurasi.URL_GET_ALL);
            }
        }
        GetJSON gj = new GetJSON();
        gj.execute();
    }

    //menampilkan data
    public void showNotif(String json){
        try {
            JSONObject jsonObject = new JSONObject(json);
            JSONArray result = jsonObject.getJSONArray(konfigurasi.TAG_JSON_ARRAY);
            for(int i=0; i<result.length(); i++)
            {
                JSONObject c = result.getJSONObject(i);
                String conveyor = c.getString(konfigurasi.TAG_CONVEYOR);
                String kerusakan = c.getString(konfigurasi.TAG_KERUSAKAN);
                notifTeknisi.setText(conveyor);
                detailNotifTeknisi.setText(kerusakan);
            }

            awal = result.length()+10;

            if(awal<akhir)
                akhir=awal;
            else if(awal==akhir)
                akhir = awal;
            else if(akhir == 0)
                akhir=awal;

            else
            {
                sendToNotification();
                akhir=awal;
            }

        } catch (JSONException e) {
            e.printStackTrace();
        }

    }

    //perintah saat menekan salah satu listview
    @Override
    public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
        Intent intent = new Intent(this, DetailHome.class);
        HashMap map =(HashMap)parent.getItemAtPosition(position);
        final String empId = (String) map.get(konfigurasi.TAG_ID);
        intent.putExtra(konfigurasi.PBM_ID,empId);


        @SuppressLint("StaticFieldLeak")
        class UpdateScan extends AsyncTask<Void,Void,String>{
            private ProgressDialog loading;
            private final String nama_teknisi1 = nama_teknisi.getText().toString().trim();
            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                loading = ProgressDialog.show(Home.this,"Updating...","Wait...",false,false);
            }

            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
                loading.dismiss();
                //Toast.makeText(Home.this,s,Toast.LENGTH_LONG).show();
            }

            @Override
            protected String doInBackground(Void... params) {
                HashMap<String,String> hashMap = new HashMap<>();
                hashMap.put(konfigurasi.KEY_EMP_ID,empId);
                hashMap.put(konfigurasi.KEY_EMP_OPEN_TEKNISI,nama_teknisi1);

                RequestHandler rh = new RequestHandler();
                return rh.sendPostRequest(konfigurasi.URL_UPDATE_NOTIFIKASI,hashMap);
            }
        }
        UpdateScan ue = new UpdateScan();
        ue.execute();

        startActivity(intent);
    }

    public void sendToNotification()
    {
        String title = "Ada kerusakan di conveyor " + notifTeknisi.getText().toString().trim();
        String message = detailNotifTeknisi.getText().toString().trim();
        Intent fullScreenIntent = new Intent(this, Welcome.class);
        PendingIntent fullScreenPendingIntent = PendingIntent.getActivity(this, 0,
                fullScreenIntent, PendingIntent.FLAG_UPDATE_CURRENT);

        Notification notification = new NotificationCompat.Builder(this, CHANNEL_1_ID)
                .setSmallIcon(R.drawable.careapp3)
                .setContentTitle(title)
                .setContentText(message)
                .setPriority(NotificationCompat.PRIORITY_HIGH)
                .setCategory(NotificationCompat.CATEGORY_MESSAGE)
                .setDefaults(Notification.DEFAULT_VIBRATE | Notification.DEFAULT_SOUND)
                .setAutoCancel(true)
                .setContentIntent(fullScreenPendingIntent)
                .build();
        notification.flags = Notification.FLAG_INSISTENT|Notification.FLAG_SHOW_LIGHTS
                |Notification.FLAG_AUTO_CANCEL|NotificationCompat.VISIBILITY_PUBLIC;
        notificationManager.notify(1, notification);
    }

    public void logout(){
        final String logout = nama_teknisi.getText().toString().trim();
        final String URL_LOGOUT = "http://192.168.10.102/android_conveyor/logout.php?username="+logout;
        @SuppressLint("StaticFieldLeak")
        class GetJSON extends AsyncTask<Void,Void,String> {

            private ProgressDialog loading;
            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                loading = ProgressDialog.show(Home.this,"Mengambil Data","Mohon Tunggu...",false,false);
            }

            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
                loading.dismiss();
                JSON_STRING = s;
                showData();
            }

            @Override
            protected String doInBackground(Void... params) {
                RequestHandler rh = new RequestHandler();
                return rh.sendGetRequest(URL_LOGOUT);
            }
        }
        GetJSON gj = new GetJSON();
        gj.execute();
    }

    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem menuItem) {
        int id = menuItem.getItemId();
        switch (id)
        {
            case R.id.nav_history:
                Intent history = new Intent(Home.this, History.class);
                startActivity(history);
                overridePendingTransition(0,0);
                finish();
                break;
            case R.id.nav_logout:
                SharedPreferences pref = getSharedPreferences("loginData", MODE_PRIVATE);
                SharedPreferences.Editor editor = pref.edit();
                editor.clear();
                editor.apply();
                overridePendingTransition(0,0);
                logout();
                Intent myIntent = new Intent(Home.this,Login.class);
                myIntent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                myIntent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
                startActivity(myIntent);
                finish();
                break;
        }
        DrawerLayout drawer = findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }

    private void getDetail()
    {
        String username_teknisi = nama_teknisi.getText().toString().trim();
        final String url_teknisi = "http://192.168.10.102/android_conveyor/profile.php?username="+username_teknisi;

        @SuppressLint("StaticFieldLeak")
        class GetJSON extends AsyncTask<Void,Void,String> {

            @Override
            protected void onPreExecute() {
                super.onPreExecute();
            }

            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
                JSON_STRING = s;
                showDetail(s);
            }

            @Override
            protected String doInBackground(Void... params) {
                RequestHandler rh = new RequestHandler();
                return rh.sendGetRequest(url_teknisi);
            }
        }
        GetJSON gj = new GetJSON();
        gj.execute();
    }

    private void showDetail(String json){
        try {
            JSONObject jsonObject = new JSONObject(json);
            JSONArray result = jsonObject.getJSONArray(konfigurasi.TAG_JSON_ARRAY);
            JSONObject c = result.getJSONObject(0);
            String nik = c.getString(konfigurasi.TAG_NIK);
            String nama = c.getString(konfigurasi.TAG_NAMA);

            tulisanNIK.setText(nik);
            tulisanNama.setText(nama);
        } catch (JSONException e) {
            e.printStackTrace();
        }
    }

    public void contentSelesai()
    {
        getNotifSelesai();
        refreshSelesai();
    }

    private void refreshSelesai()
    {
        final Handler handler = new Handler();
        final Runnable runnable = new Runnable() {
            @Override
            public void run() {
                contentSelesai();
            }
        };
        handler.postDelayed(runnable, 1000);
    }

    //mengambil data notif
    private void getNotifSelesai(){
        @SuppressLint("StaticFieldLeak")
        class GetJSON extends AsyncTask<Void,Void,String> {

            //ProgressDialog loading;
            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                //loading = ProgressDialog.show(Home.this,"Mengambil Data","Mohon Tunggu...",false,false);
            }

            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
                //loading.dismiss();
                JSON_STRING = s;
                showNotifSelesai(s);
            }

            @Override
            protected String doInBackground(Void... params) {
                RequestHandler rh = new RequestHandler();
                return rh.sendGetRequest(konfigurasi.URL_HISTORY);
            }
        }
        GetJSON gj = new GetJSON();
        gj.execute();
    }

    //menampilkan data
    private void showNotifSelesai(String json){
        try {
            JSONObject jsonObject = new JSONObject(json);
            JSONArray result1 = jsonObject.getJSONArray(konfigurasi.TAG_JSON_ARRAY);
            for(int i=0; i<result1.length(); i++)
            {
                JSONObject c = result1.getJSONObject(i);
                String conveyor = c.getString(konfigurasi.TAG_CONVEYOR);
                notifTeknisi.setText(conveyor);
            }

            first = result1.length()+1;

            if(first<last)
                last=first;
            else if(first==last)
                last=first;
            else if(last == 0)
                last=first;
            else
            {
                sendToNotificationSelesai();
                last=first;
            }

        } catch (JSONException e) {
            e.printStackTrace();
        }

    }

    private void sendToNotificationSelesai()
    {
        String title = "Problem di conveyor " + notifTeknisi.getText().toString().trim() + " selesai diperbaiki";
        String text = "Oleh " + tulisanNama.getText().toString().trim();
        Intent fullScreenIntent = new Intent(this, Welcome_history.class);
        PendingIntent fullScreenPendingIntent = PendingIntent.getActivity(this, 0,
                fullScreenIntent, PendingIntent.FLAG_UPDATE_CURRENT);

        Notification notification = new NotificationCompat.Builder(this, CHANNEL_2_ID)
                .setSmallIcon(R.drawable.careapp3)
                .setContentTitle(title)
                .setContentText(text)
                .setPriority(NotificationCompat.PRIORITY_HIGH)
                .setCategory(NotificationCompat.CATEGORY_MESSAGE)
                .setDefaults(Notification.DEFAULT_VIBRATE | Notification.DEFAULT_SOUND)
                .setAutoCancel(true)
                .setContentIntent(fullScreenPendingIntent)
                .build();

        notification.flags = Notification.FLAG_INSISTENT|Notification.FLAG_SHOW_LIGHTS|
                Notification.FLAG_AUTO_CANCEL|NotificationCompat.VISIBILITY_PUBLIC;

        notificationManager.notify(50, notification);
    }
}
