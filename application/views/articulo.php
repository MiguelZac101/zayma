<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
            
            <h1><?php echo $articulo['titulo']; ?></h1>  
            <img src="<?php echo base_url($articulo['imagen']); ?>" alt="<?php echo $articulo['titulo']; ?>" class="img-responsive">
            <br/>
            <div id="redes_sociales_articulo">
                <div class="fb_btn_like">
                    <div class="fb-like" data-share="false" data-show-faces="false" data-layout="button"></div>              
                </div>
                <div class="fb_btn_share">
                    <div class="fb-share-button" data-href="<?php echo base_url($url_articulo);?>#disqus_thread" data-layout="button_count"></div>
                </div>
                <div class="twitter_share">
                    <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://velascoperu.com.pe/noticias/noticias/nadine-heredia-el-apra-saco-agendas-para-tapar-narcoindultos#disqus_thread" data-via="VelascoPer" data-related="VelascoPer" data-hashtags="VelascoPerú">Tweet</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                </div>
                <div class="google_share">
                    <!-- Inserta esta etiqueta donde quieras que aparezca Botón +1. -->
                    <div class="g-plusone"></div>
                </div>           
                
                
            </div>
            <br/>           
            <div>
                <?php echo $articulo['contenido']; ?>
            </div>
            <br/>
             <div id="disqus_thread"></div>
<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES * * */
    var disqus_shortname = 'velascoperperu';
    
    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
            <br/>
            
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
            <?php             

                echo $opinion_editor;                       
                
//                $this->load->view("opinion_colaboradores");
                echo $opinion_colaborador;
            ?>
        </div>
    </div>
</div>          
            
            
