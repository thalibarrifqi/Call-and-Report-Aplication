package com.example.ekybintarnow.bottomnavigationview;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Handler;
import androidx.appcompat.app.AppCompatActivity;
import android.os.Bundle;


public class Welcome extends AppCompatActivity {

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
                    startActivity(new Intent(getApplicationContext(), Login.class));
                    overridePendingTransition(0,0);
                }
                else
                {
                    startActivity(new Intent(getApplicationContext(), Home.class));
                    overridePendingTransition(0,0);
                }
                Welcome.this.finish();
            }
        }, 500);
    }
}
