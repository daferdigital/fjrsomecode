function popup(mylink, windowname)
    {
        if (! window.focus)
            return true;
        var href;
        if (typeof(mylink) == 'string')
           href=mylink;
        else
            href=mylink.href;
        window.open(href, windowname, 'width=350,height=400,scrollbars=yes');
        return false;
    }

    function popup2(mylink, windowname)
    {
        if (! window.focus)
            return true;
        var href;
        if (typeof(mylink) == 'string')
           href=mylink;
        else
            href=mylink.href;
        window.open(href, windowname, 'width=600,height=300,scrollbars=yes');
        return false;
    }

   

