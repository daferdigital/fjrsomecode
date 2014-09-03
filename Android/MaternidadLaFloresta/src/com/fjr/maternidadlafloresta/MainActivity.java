package com.fjr.maternidadlafloresta;

import java.util.ArrayList;
import java.util.HashMap;

import android.os.Bundle;
import android.app.Activity;
import android.view.Menu;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.ListView;
import android.widget.Toast;

/**
 * Clase principal donde se refresca cada N segundos.
 * 
 * @author FJR
 *
 */
public class MainActivity extends Activity implements OnClickListener {
	// Hashmap for ListView
    private ArrayList<HashMap<String, String>> listaLlamadas;
    
	@Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        
        Button refrescar = (Button) findViewById(R.id.botonRefrescarMain);
        refrescar.setOnClickListener(this);
        //refrescar.callOnClick();
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.activity_main, menu);
        return true;
    }
    
    
    /*
    @Override
    protected void onListItemClick(ListView l, View v, int position, long id) {
    	String item = (String) getListAdapter().getItem(position);
    	Toast.makeText(this, item + " selected",
    			Toast.LENGTH_LONG).show();
    }
    */
	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		switch (v.getId()) {
			case R.id.botonRefrescarMain:
				new RefrescarLlamadas(this).execute();
				break;
		}
	}
	
	/**
	 * 
	 * @return
	 */
	public ArrayList<HashMap<String, String>> getListaLlamadas() {
		if(listaLlamadas == null){
			listaLlamadas = new ArrayList<HashMap<String,String>>();
		}
		
		return listaLlamadas;
	}
}
