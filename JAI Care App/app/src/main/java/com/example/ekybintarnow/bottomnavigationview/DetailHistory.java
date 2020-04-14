package com.example.ekybintarnow.bottomnavigationview;

import androidx.appcompat.app.AppCompatActivity;

import android.annotation.SuppressLint;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.RatingBar;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;

public class DetailHistory extends AppCompatActivity implements View.OnClickListener
{
    private EditText lihatConveyor;
    private EditText lihatKerusakan;
    private EditText lihatKeterangan;
    private EditText lihatTeknisi;
    private EditText ratingValue;
    private EditText feedbackTeknisi;
    private EditText lookFeedbackGL;
    private EditText lookRatingGL;
    private RatingBar ratingBar;
    private RatingBar ratingBarGL;
    private String id;
    private Button btnSendRating;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail_history);

        Intent intent = getIntent();

        id = intent.getStringExtra(konfigurasi.PBM_ID);

        EditText lihatId = findViewById(R.id.lihatId);
        lihatConveyor = findViewById(R.id.lihatConveyor);
        lihatKerusakan = findViewById(R.id.lihatKerusakan);
        lihatKeterangan = findViewById(R.id.lihatKeterangan);
        lihatTeknisi = findViewById(R.id.lihatTeknisi);

        feedbackTeknisi = findViewById(R.id.feedbackTeknisi);
        ratingValue = findViewById(R.id.ratingValue);

        lookFeedbackGL = findViewById(R.id.lihatFeedbackGL);
        lookRatingGL = findViewById(R.id.lihatRatingGL);
        ratingBar = findViewById(R.id.ratingBar);
        ratingBarGL = findViewById(R.id.ratingBarGL);
        ratingBar.setOnRatingBarChangeListener(new RatingBar.OnRatingBarChangeListener() {
            @SuppressLint("SetTextI18n")
            @Override
            public void onRatingChanged(RatingBar ratingBar, float nilai, boolean fromUser) {
                ratingValue.setText(" " + nilai);
            }
        });

        feedbackTeknisi.addTextChangedListener(komparasi);
        ratingValue.addTextChangedListener(komparasi);


        btnSendRating = findViewById(R.id.btnRating);
        btnSendRating.setOnClickListener(this);

        btnSendRating.setEnabled(false);
        feedbackTeknisi.setFocusable(false);
        ratingBar.setIsIndicator(true);

        lihatId.setText(id);

        getProblem();
    }

    private TextWatcher komparasi = new TextWatcher() {
        @Override
        public void beforeTextChanged(CharSequence s, int start, int count, int after) {

        }

        @Override
        public void onTextChanged(CharSequence s, int start, int before, int count)
        {
            if(s.toString().trim().length()==0)
            {
                ratingBar.setIsIndicator(false);
                feedbackTeknisi.setFocusableInTouchMode(true);
                btnSendRating.setEnabled(true);
            }
        }

        @Override
        public void afterTextChanged(Editable s)
        {

        }
    };


    private void getProblem(){
        @SuppressLint("StaticFieldLeak")
        class GetProblem extends AsyncTask<Void,Void,String> {
            private ProgressDialog loading;
            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                loading = ProgressDialog.show(DetailHistory.this,"Fetching...","Wait...",false,false);
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
                return rh.sendGetRequestParam(konfigurasi.URL_GET_DETAIL_HISTORY,id);
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
            String teknisi = c.getString(konfigurasi.TAG_TEKNISI);
            String rating_teknisi = c.getString(konfigurasi.TAG_RATING_TEKNISI);
            String feedback_teknisi = c.getString(konfigurasi.TAG_FEEDBACK_TEKNISI);
            String rating_gl = c.getString(konfigurasi.TAG_RATING_GL);
            String feedback_gl = c.getString(konfigurasi.TAG_FEEDBACK_GL);

            lihatConveyor.setText(conveyor);
            lihatKerusakan.setText(kerusakan);
            lihatKeterangan.setText(keterangan);
            lihatTeknisi.setText(teknisi);
            ratingValue.setText(rating_teknisi);
            feedbackTeknisi.setText(feedback_teknisi);
            lookRatingGL.setText(rating_gl);
            lookFeedbackGL.setText(feedback_gl);
            if(rating_gl.trim().length()!=0)
            {
                ratingBarGL.setRating(Float.parseFloat(rating_gl));
            }

            if(rating_teknisi.trim().length() != 0)
            {
                ratingBar.setRating(Float.parseFloat(rating_teknisi));
            }

        } catch (JSONException e) {
            e.printStackTrace();
        }
    }

    private void sendFeedback()
    {
        final String rating_value = ratingValue.getText().toString().trim();
        final String feedback_teknisi = feedbackTeknisi.getText().toString().trim();
        @SuppressLint("StaticFieldLeak")
        class UpdateScan extends AsyncTask<Void,Void,String>{
            private ProgressDialog loading;
            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                loading = ProgressDialog.show(DetailHistory.this,"Updating...","Wait...",false,false);
            }

            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
                loading.hide();
                Toast.makeText(DetailHistory.this,s,Toast.LENGTH_LONG).show();
            }

            @Override
            protected String doInBackground(Void... params) {
                HashMap<String,String> hashMap = new HashMap<>();
                hashMap.put(konfigurasi.KEY_EMP_ID,id);
                hashMap.put(konfigurasi.KEY_EMP_RATING_VALUE,rating_value);
                hashMap.put(konfigurasi.KEY_EMP_FEEDBACK_VALUE,feedback_teknisi);

                RequestHandler rh = new RequestHandler();

                return rh.sendPostRequest(konfigurasi.URL_RATING,hashMap);
            }
        }
        UpdateScan ue = new UpdateScan();
        ue.execute();
    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        finish();
    }

    @Override
    public void onClick(View v)
    {
        if(v == btnSendRating)
        {
            sendFeedback();
            DetailHistory.this.finish();
            btnSendRating.setEnabled(false);
            startActivity(new Intent(getApplicationContext(), History.class));
            overridePendingTransition(0,0);
        }
    }
}
