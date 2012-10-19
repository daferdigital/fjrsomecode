// Decompiled by Jad v1.5.8g. Copyright 2001 Pavel Kouznetsov.
// Jad home page: http://www.kpdus.com/jad.html
// Decompiler options: packimports(3) 

package com.ehp.droidsf.clientes;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
import android.view.View;
import android.widget.ListView;
import android.widget.TextView;

import com.ehp.R;
import com.ehp.droidsf.MainActivity;
import com.ehp.droidsf.adapters.AdapterClientes;
import com.ehp.droidsf.db.CursorClientes;

// Referenced classes of package com.ehp.droidsf.clientes:
//            FichaCliente

public class ConsultarClientes extends Activity
{

    public ConsultarClientes()
    {
        textWatcher = new _cls1();
        oclFiltrarPorCriterio = new _cls2();
        oclVerFichaClientes = new _cls3();
    }

    private Intent getIntentFichaCliente()
    {
        if(fichaCliente == null)
            fichaCliente = new Intent(MainActivity.mainCtx, FichaCliente.class);
        return fichaCliente;
    }

    protected void onCreate(Bundle bundle)
    {
        super.onCreate(bundle);
        requestWindowFeature(1);
        setContentView(R.layout.consultar_clientes_activity_layout);
        lv = (ListView)findViewById(0x7f060050);
        campoFiltro = (TextView)findViewById(0x7f060015);
        campoFiltro.addTextChangedListener(textWatcher);
        oclFiltrarPorCriterio.onClick(null);
    }

    private static final int INTENT_REQUEST_AGREGAR_NUEVO_CLIENTE = 1;
    private TextView campoFiltro;
    private CursorClientes cc;
    private Intent fichaCliente;
    private ListView lv;
    android.view.View.OnClickListener oclFiltrarPorCriterio;
    android.view.View.OnClickListener oclVerFichaClientes;
    private AdapterClientes padaptc;
    private TextWatcher textWatcher;








    private class _cls1
        implements TextWatcher
    {

        public void afterTextChanged(Editable editable)
        {
            oclFiltrarPorCriterio.onClick(null);
        }

        public void beforeTextChanged(CharSequence charsequence, int i, int j, int k)
        {
        }

        public void onTextChanged(CharSequence charsequence, int i, int j, int k)
        {
        }

        final ConsultarClientes this$0;

        _cls1()
        {
        	super();
        	this$0 = ConsultarClientes.this;
        }
    }


    private class _cls2
        implements android.view.View.OnClickListener
    {

        public void onClick(View view)
        {
            String s = campoFiltro.getText().toString().trim();
            if(s.length() == 0)
                s = "";
            cc = MainActivity.mDbHelper.getListadoClientes(s, com.ehp.droidsf.db.CursorClientes.SortBy.nombre);
            padaptc = new AdapterClientes(ConsultarClientes.this, cc, oclVerFichaClientes);
            lv.setAdapter(padaptc);
            lv.setCacheColorHint(0);
        }

        final ConsultarClientes this$0;

        _cls2()
        {
        	super();
        	this$0 = ConsultarClientes.this;
        }
    }


    private class _cls3
        implements android.view.View.OnClickListener
    {

        public void onClick(View view)
        {
            int i = Integer.parseInt(view.getTag().toString());
            cc.moveToPosition(i);
            Intent intent = getIntentFichaCliente();
            intent.putExtra("ID_CLIENTE", cc.getId());
            boolean flag;
            if(cc.getCodigo().equalsIgnoreCase("NONE"))
                flag = false;
            else
                flag = true;
            intent.putExtra("PROFIT", flag);
            startActivity(intent);
        }

        final ConsultarClientes this$0;

        _cls3()
        {
        	super();
        	this$0 = ConsultarClientes.this;
        }
    }

}
