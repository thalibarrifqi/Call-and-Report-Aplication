package com.example.ekybintarnow.bottomnavigationview;

import android.annotation.SuppressLint;
import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import androidx.appcompat.app.AppCompatActivity;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;

import static com.example.ekybintarnow.bottomnavigationview.Login.Username;

public class DetailHome extends AppCompatActivity implements View.OnClickListener {

    private EditText updConveyor;
    private EditText updKerusakan;
    private EditText updKeterangan;
    private EditText updStatus;
    private EditText updStartDate;
    private EditText updScanDate;
    private EditText updKonfirmasiDate;
    private EditText updKonfirmasiTeknisi;
    private EditText viewTeknisi;
    private EditText updTeknisiValidasi;
    @SuppressLint("StaticFieldLeak")
    public static EditText updQrcode,viewQrcode, updTeknisi;
    private String id;
    private Button buttonUpdate, buttonScanner;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail_home);

        Intent intent = getIntent();
        id = intent.getStringExtra(konfigurasi.PBM_ID);

        EditText updId =findViewById(R.id.updId);
        updConveyor = findViewById(R.id.updConveyor);
        updKerusakan = findViewById(R.id.updKerusakan);
        updKeterangan = findViewById(R.id.updKeterangan);
        updStatus = findViewById(R.id.updStatus);
        updStartDate = findViewById(R.id.updStartDate);
        updScanDate = findViewById(R.id.updScanDate);
        updTeknisiValidasi = findViewById(R.id.updValidasiTeknisi);
        updKonfirmasiDate = findViewById(R.id.updKonfirmasiDate);
        updKonfirmasiTeknisi =  findViewById(R.id.updKonfirmasiTeknisi);
        viewQrcode=findViewById(R.id.viewQrcode);
        updQrcode =findViewById(R.id.updQrcode);
        updTeknisi =findViewById(R.id.updTeknisi);
        viewTeknisi =findViewById(R.id.viewTeknisi);

        SharedPreferences pref = getSharedPreferences("loginData", MODE_PRIVATE);
        String teknisi = pref.getString(Username,"");
        updTeknisi.setText(teknisi);

        buttonUpdate =findViewById(R.id.buttonUpdate);
        buttonScanner =findViewById(R.id.buttonScanner);

        buttonUpdate.setOnClickListener(this);
        buttonScanner.setOnClickListener(this);

        buttonUpdate.setEnabled(false);
        updId.setText(id);

        viewQrcode.addTextChangedListener(compare);
        updQrcode.addTextChangedListener(compare);

        updKonfirmasiTeknisi.addTextChangedListener(konfirmasi);
        updKonfirmasiDate.addTextChangedListener(konfirmasi);

        updScanDate.addTextChangedListener(new TextWatcher() {
            @Override
            public void beforeTextChanged(CharSequence s, int start, int count, int after) {

            }

            @Override
            public void onTextChanged(CharSequence s, int start, int before, int count) {
                if(s.toString().trim().length()!=0)
                {
                    buttonScanner.setEnabled(false);
                    buttonUpdate.setEnabled(true);
                }

            }

            @Override
            public void afterTextChanged(Editable s) {

            }
        });

        getProblem();
    }

    private TextWatcher compare = new TextWatcher() {
        @Override
        public void beforeTextChanged(CharSequence s, int start, int count, int after) {

        }

        @Override
        public void onTextChanged(CharSequence s, int start, int before, int count) {
            String qrr = updQrcode.getText().toString().trim();
            String viewqr = viewQrcode.getText().toString().trim();

            if(qrr.equalsIgnoreCase(viewqr))
            {
                updateScan();
                buttonScanner.setEnabled(false);
                buttonUpdate.setEnabled(true);
            }
        }
        @Override
        public void afterTextChanged(Editable s) {

        }
    };

    private TextWatcher konfirmasi = new TextWatcher() {
        @Override
        public void beforeTextChanged(CharSequence s, int start, int count, int after) {

        }

        @Override
        public void onTextChanged(CharSequence s, int start, int before, int count) {
            if(s.toString().trim().length()!=0)
            {
                buttonScanner.setEnabled(false);
                buttonUpdate.setEnabled(false);
            }
        }

        @Override
        public void afterTextChanged(Editable s) {

        }
    };

    private void getProblem(){
        @SuppressLint("StaticFieldLeak")
        class GetProblem extends AsyncTask<Void,Void,String> {
            private ProgressDialog loading;
            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                loading = ProgressDialog.show(DetailHome.this,"Fetching...","Wait...",false,false);
            }

            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
                loading.dismiss();
                showEmployee(s);
            }

            @Override
            protected String doInBackground(Void... params) {
                RequestHandler rh = new RequestHandler();
                return rh.sendGetRequestParam(konfigurasi.URL_GET_EMP,id);
            }
        }
        GetProblem ge = new GetProblem();
        ge.execute();
    }

    private void showEmployee(String json){
        try {
            JSONObject jsonObject = new JSONObject(json);
            JSONArray result = jsonObject.getJSONArray(konfigurasi.TAG_JSON_ARRAY);
            JSONObject c = result.getJSONObject(0);
            String conveyor = c.getString(konfigurasi.TAG_CONVEYOR);
            String kerusakan = c.getString(konfigurasi.TAG_KERUSAKAN);
            String keterangan = c.getString(konfigurasi.TAG_KETERANGAN);
            String status = c.getString(konfigurasi.TAG_STATUS);
            String start_date = c.getString(konfigurasi.TAG_START_DATE);
            String scan_date = c.getString(konfigurasi.TAG_SCAN_DATE);
            String konfirmasi_date = c.getString(konfigurasi.TAG_KONFIRMASI_DATE);
            String konfirmasi_teknisi = c.getString(konfigurasi.TAG_KONFIRMASI_TEKNISI);
            String qrcode = c.getString(konfigurasi.TAG_QRCODE);
            String teknisi = c.getString(konfigurasi.TAG_TEKNISI);
            String validasi_teknisi = c.getString(konfigurasi.TAG_NAMA_VALIDASI);

            updConveyor.setText(conveyor);
            updKerusakan.setText(kerusakan);
            updKeterangan.setText(keterangan);
            updStatus.setText(status);
            updStartDate.setText(start_date);
            updScanDate.setText(scan_date);
            updKonfirmasiDate.setText(konfirmasi_date);
            updKonfirmasiTeknisi.setText(konfirmasi_teknisi);
            viewQrcode.setText(qrcode);
            viewTeknisi.setText(teknisi);
            updTeknisiValidasi.setText(validasi_teknisi);

        } catch (JSONException e) {
            e.printStackTrace();
        }
    }

    private void updateEmployee(){
        final String konfirmasi_date = updKonfirmasiDate.getText().toString().trim();
        final String konfirmasi_teknisi = updKonfirmasiTeknisi.getText().toString().trim();
        final String teknisi = updTeknisi.getText().toString().trim();

        @SuppressLint("StaticFieldLeak")
        class UpdateEmployee extends AsyncTask<Void,Void,String>{
            private ProgressDialog loading;
            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                loading = ProgressDialog.show(DetailHome.this,"Updating...","Wait...",false,false);
            }

            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
                loading.dismiss();
                Toast.makeText(DetailHome.this,s,Toast.LENGTH_LONG).show();
            }

            @Override
            protected String doInBackground(Void... params) {
                HashMap<String,String> hashMap = new HashMap<>();
                hashMap.put(konfigurasi.KEY_EMP_ID,id);
                hashMap.put(konfigurasi.KEY_EMP_KONFIRMASI_DATE,konfirmasi_date);
                hashMap.put(konfigurasi.KEY_EMP_KONFIRMASI_TEKNISI,konfirmasi_teknisi);
                hashMap.put(konfigurasi.KEY_EMP_TEKNISI, teknisi);

                RequestHandler rh = new RequestHandler();

                return rh.sendPostRequest(konfigurasi.URL_UPDATE_EMP,hashMap);
            }
        }
        UpdateEmployee ue = new UpdateEmployee();
        ue.execute();
    }

    private void updateScan()
    {
        final String scan_date = updScanDate.getText().toString().trim();
        final String validasi_teknisi = updTeknisi.getText().toString().trim();
        @SuppressLint("StaticFieldLeak")
        class UpdateScan extends AsyncTask<Void,Void,String>{
            private ProgressDialog loading;
            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                loading = ProgressDialog.show(DetailHome.this,"Updating...","Wait...",false,false);
            }

            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
                loading.dismiss();
                Toast.makeText(DetailHome.this,s,Toast.LENGTH_LONG).show();
            }

            @Override
            protected String doInBackground(Void... params) {
                HashMap<String,String> hashMap = new HashMap<>();
                hashMap.put(konfigurasi.KEY_EMP_ID,id);
                hashMap.put(konfigurasi.KEY_EMP_SCAN_DATE,scan_date);
                hashMap.put(konfigurasi.KEY_EMP_VALIDASI_TEKNISI, validasi_teknisi);

                RequestHandler rh = new RequestHandler();
                return rh.sendPostRequest(konfigurasi.URL_UPDATE_SCAN,hashMap);
            }
        }
        UpdateScan ue = new UpdateScan();
        ue.execute();
    }

    @Override
    public void onClick(View v) {

        if(v == buttonScanner)
        {
            startActivity(new Intent(getApplicationContext(), Scanner.class));
        }
        if(v == buttonUpdate){
            updateEmployee();
            DetailHome.this.finish();
            startActivity(new Intent(getApplicationContext(), Home.class));
            overridePendingTransition(0,0);
        }
    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        finish();
    }
}