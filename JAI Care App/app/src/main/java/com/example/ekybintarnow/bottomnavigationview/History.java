package com.example.ekybintarnow.bottomnavigationview;

import android.annotation.SuppressLint;
import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.EditText;
import android.widget.ListAdapter;
import android.widget.ListView;
import android.widget.SimpleAdapter;
import android.widget.TextView;


import androidx.annotation.NonNull;
import androidx.appcompat.app.ActionBarDrawerToggle;
import androidx.core.view.GravityCompat;
import com.google.android.material.navigation.NavigationView;
import androidx.drawerlayout.widget.DrawerLayout;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;


import static com.example.ekybintarnow.bottomnavigationview.Login.Username;

public class History extends AppCompatActivity implements ListView.OnItemClickListener, NavigationView.OnNavigationItemSelectedListener {

    private ListView listView;
    private String JSON_STRING;
    private SwipeRefreshLayout swipeRefreshLayout;
    private EditText nama_teknisi1;
    public TextView tulisanNIK1, tulisanNama1;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_history1);
        Toolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        DrawerLayout drawer = findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(this, drawer, toolbar, R.string.drawerOpen, R.string.drawerClose);
        drawer.addDrawerListener(toggle);
        toggle.syncState();

        NavigationView navigationView = findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);
        View headerView = navigationView.getHeaderView(0);
        tulisanNIK1 = headerView.findViewById(R.id.cobaNIK);
        tulisanNama1 = headerView.findViewById(R.id.cobaNama);

        listView = findViewById(R.id.listViewHistory);
        listView.setOnItemClickListener(this);


        nama_teknisi1=findViewById(R.id.teknisi1);
        SharedPreferences pref = getSharedPreferences("loginData", MODE_PRIVATE);
        String teknisi = pref.getString(Username,"");
        nama_teknisi1.setText(teknisi);
        getJSON();
        getNama();
//        contentSelesai();
        swipeRefreshLayout =  findViewById(R.id.swipe_refresh_layout);
        swipeRefreshLayout.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                getJSON();
                swipeRefreshLayout.setRefreshing(false);
            }
        });


    }

    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem menuItem) {
        int id = menuItem.getItemId();
        switch (id)
        {
            case R.id.nav_home:
                Intent history = new Intent(History.this, Home.class);
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
                logout1();
                Intent myIntent = new Intent(History.this,Login.class);
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

    private void getJSON(){
        @SuppressLint("StaticFieldLeak")
        class GetJSON extends AsyncTask<Void,Void,String> {

            private ProgressDialog loading;
            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                loading = ProgressDialog.show(History.this,"Mengambil Data","Mohon Tunggu...",false,false);
            }

            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
                loading.dismiss();
                JSON_STRING = s;
                showEmployee();
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

    private void showEmployee(){
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
                String end_date = jo.getString(konfigurasi.TAG_END_DATE);
                String rating = jo.getString(konfigurasi.TAG_RATING_TEKNISI);

                HashMap<String,String> employees = new HashMap<>();
                employees.put(konfigurasi.TAG_ID,id);
                employees.put(konfigurasi.TAG_CONVEYOR,conveyor);
                employees.put(konfigurasi.TAG_KERUSAKAN,kerusakan);
                employees.put(konfigurasi.TAG_KETERANGAN,keterangan);
                employees.put(konfigurasi.TAG_STATUS,status);
                employees.put(konfigurasi.TAG_END_DATE,end_date);
                employees.put(konfigurasi.TAG_RATING_TEKNISI,rating);

                list.add(employees);
            }

        } catch (JSONException e) {
            e.printStackTrace();
        }

        ListAdapter adapter = new SimpleAdapter(
                History.this, list, R.layout.list_item_history,
                new String[]{konfigurasi.TAG_ID, konfigurasi.TAG_CONVEYOR,konfigurasi.TAG_KERUSAKAN,konfigurasi.TAG_KETERANGAN,
                        konfigurasi.TAG_STATUS,konfigurasi.TAG_END_DATE, konfigurasi.TAG_RATING_TEKNISI},
                new int[]{R.id.viewId, R.id.viewConveyor, R.id.viewKerusakan, R.id.viewKeterangan, R.id.viewStatus, R.id.viewDate
                        , R.id.viewRated});

        listView.setAdapter(adapter);
    }


//    public void contentSelesai()
//    {
//        getNotifSelesai();
//        refresh();
//    }
//
//    private void refresh()
//    {
//        final Handler handler = new Handler();
//        final Runnable runnable = new Runnable() {
//            @Override
//            public void run() {
//                contentSelesai();
//            }
//        };
//        handler.postDelayed(runnable, 1000);
//    }

    public void logout1(){
        final String logout = nama_teknisi1.getText().toString().trim();
        final String URL_LOGOUT = "http://192.168.10.102/android_conveyor/logout.php?username="+logout;
        @SuppressLint("StaticFieldLeak")
        class GetJSON extends AsyncTask<Void,Void,String> {

            private ProgressDialog loading;
            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                loading = ProgressDialog.show(History.this,"Mengambil Data","Mohon Tunggu...",false,false);
            }

            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
                loading.dismiss();
                JSON_STRING = s;
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

    //perintah saat menekan salah satu listview
    @Override
    public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
        Intent intent = new Intent(this, DetailHistory.class);
        HashMap map =(HashMap)parent.getItemAtPosition(position);
        final String empId = (String) map.get(konfigurasi.TAG_ID);
        intent.putExtra(konfigurasi.PBM_ID,empId);
        startActivity(intent);
    }

    public void getNama()
    {
        final String nama_teknisi = nama_teknisi1.getText().toString().trim();
        final String url_teknisi = "http://192.168.10.102/android_conveyor/profile.php?username="+nama_teknisi;

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
                showDetail1(s);
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

    private void showDetail1(String json){
        try {
            JSONObject jsonObject = new JSONObject(json);
            JSONArray result = jsonObject.getJSONArray(konfigurasi.TAG_JSON_ARRAY);
            JSONObject c = result.getJSONObject(0);
            String nik = c.getString(konfigurasi.TAG_NIK);
            String nama = c.getString(konfigurasi.TAG_NAMA);

            tulisanNIK1.setText(nik);
            tulisanNama1.setText(nama);
        } catch (JSONException e) {
            e.printStackTrace();
        }
    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        finish();
    }
}
