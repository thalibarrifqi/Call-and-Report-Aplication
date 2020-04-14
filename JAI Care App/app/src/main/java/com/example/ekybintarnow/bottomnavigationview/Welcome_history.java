package com.example.ekybintarnow.bottomnavigationview;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.os.Handler;

import androidx.appcompat.app.AppCompatActivity;


public class Welcome_history extends AppCompatActivity {

    String usernameStored="", passwordStored="";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_welcome);

        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                SharedPreferences pref = getSharedPreferences("loginData", MODE_PRIVATE);

                usernameStored = pref.getString("username", null);
                passwordStored = pref.getString("password", null);

                if(usernameStored == null)
                {
                    startActivity(new Intent(getApplicationContext(), Login_history.class));
                    overridePendingTransition(0,0);
                }
                else
                {
                    startActivity(new Intent(getApplicationContext(), History.class));
                    overridePendingTransition(0,0);
                }
                Welcome_history.this.finish();
            }
        }, 500);
    }
}
