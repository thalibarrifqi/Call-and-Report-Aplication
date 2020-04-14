package com.example.ekybintarnow.bottomnavigationview;

import android.content.Intent;
import android.content.SharedPreferences;
import android.net.wifi.WifiInfo;
import android.net.wifi.WifiManager;
import android.os.Bundle;
import android.text.format.Formatter;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.util.HashMap;
import java.util.Map;
import java.util.Objects;

public class Login_history extends AppCompatActivity {

    Button btn_login;
    EditText et_username, et_password;
    TextView ipAddress;
    static final String Username = "username";
    static final String Password = "password";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        btn_login = findViewById(R.id.btn_login);
        et_username = findViewById(R.id.et_username);
        et_password = findViewById(R.id.et_password);

        ipAddress = findViewById(R.id.wifiIP);
        WifiManager wifiMgr = (WifiManager) getApplicationContext().getSystemService(WIFI_SERVICE);
        WifiInfo wifiInfo = Objects.requireNonNull(wifiMgr).getConnectionInfo();
        int ip = wifiInfo.getIpAddress();
        String ipWifi = Formatter.formatIpAddress(ip);
        ipAddress.setText(ipWifi);
        ipAddress.setVisibility(View.INVISIBLE);

        btn_login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                login();
            }
        });
    }

    public void login() {
        String url = "http://192.168.10.102/android_conveyor/login.php";
        final String username = et_username.getText().toString();
        final String password = et_password.getText().toString();
        StringRequest request = new StringRequest(Request.Method.POST, url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        if (response.contains("1") || response.contains("sukses")) {
                            SharedPreferences pref = getSharedPreferences("loginData", MODE_PRIVATE);
                            SharedPreferences.Editor editor = pref.edit();
                            editor.putString(Username, username);
                            editor.putString(Password, password);
                            editor.apply();
                            startActivity(new Intent(getApplicationContext(), History.class));
                            finish();
                        } else {
                            Toast.makeText(getApplicationContext(), "Username atau password salah",
                                    Toast.LENGTH_SHORT).show();
                        }
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(getApplicationContext(), "Cek koneksi anda!", Toast.LENGTH_SHORT).show();
            }
        }) {
            @Override
            protected Map<String, String> getParams() {
                Map<String, String> params = new HashMap<>();
                params.put("username", et_username.getText().toString());
                params.put("password", et_password.getText().toString());
                return params;
            }
        };
        Volley.newRequestQueue(this).add(request);
    }
}
