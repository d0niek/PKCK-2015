<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" 
    xmlns:fo="http://www.w3.org/1999/XSL/Format"
    version="1.0">
<xsl:output encoding="UTF-8" indent="yes" method="xml" standalone="no" omit-xml-declaration="no"/>
    
    <xsl:key name="jeden_gatunek" match="/kolekcja/podsumowanie/gatunki/gatunek/text()" use="." />
    
    <xsl:template match="/kolekcja">  
        <fo:root>

        <fo:layout-master-set>
            <fo:simple-page-master master-name="default" margin-left="15mm" margin-right="15mm" margin-top="15mm" margin-bottom="15mm">
                <fo:region-body margin-top="10mm" />
                <fo:region-before region-name="nagłówek" />
            </fo:simple-page-master>
        </fo:layout-master-set>
        <fo:page-sequence master-reference="default">
            <fo:static-content flow-name="nagłówek">
                <fo:block><xsl:value-of select="concat(nagłówek/opis, ' - ', nagłówek/data)"/></fo:block>
            </fo:static-content>
            <fo:flow flow-name="xsl-region-body">
                <xsl:apply-templates />
            </fo:flow>
        </fo:page-sequence>

        </fo:root>
    </xsl:template>
    
    <xsl:template match="wykonawcy/wykonawca">
            <fo:table table-layout="fixed" width="100%" font-size="10pt" border-color="black" border-width="0.4mm" border-style="solid" padding="1mm">
                <fo:table-column column-width="proportional-column-width(5)"/>
                <fo:table-column column-width="proportional-column-width(30)"/>
                <fo:table-column column-width="proportional-column-width(10)"/>     
                <fo:table-column column-width="proportional-column-width(10)"/>
                <fo:table-column column-width="proportional-column-width(15)"/>
                <fo:table-column column-width="proportional-column-width(10)"/>
                <fo:table-column column-width="proportional-column-width(10)"/> 
                <fo:table-header>
                    <fo:table-row>
                        <fo:table-cell number-columns-spanned="7" text-align="left" border-bottom-style="solid" border-bottom-width="0.2mm">
                        <fo:block font-weight="bold" color="#6F0038" padding="1mm" text-align-last="justify">
                            <xsl:value-of select="nazwa"/>
                            <fo:leader leader-pattern="space" />
                            <xsl:text>gatunek: </xsl:text>
                            <xsl:value-of select="gatunek"/>
                        </fo:block>
                        </fo:table-cell>
                    </fo:table-row>
                </fo:table-header>
                
                <fo:table-body>
                
                    <fo:table-row>
                        <fo:table-cell padding="1mm"><fo:block font-weight="bold">ID</fo:block></fo:table-cell>
                        <fo:table-cell padding="1mm"><fo:block font-weight="bold">tytuł</fo:block></fo:table-cell>
                        <fo:table-cell padding="1mm"><fo:block font-weight="bold">ranking</fo:block></fo:table-cell>
                        <fo:table-cell padding="1mm"><fo:block font-weight="bold">utworów</fo:block></fo:table-cell>
                        <fo:table-cell padding="1mm"><fo:block font-weight="bold">czas trwania</fo:block></fo:table-cell>
                        <fo:table-cell padding="1mm"><fo:block font-weight="bold">VAT</fo:block></fo:table-cell>
                        <fo:table-cell padding="1mm"><fo:block font-weight="bold">brutto</fo:block></fo:table-cell>
                    </fo:table-row>
                    
                    <xsl:apply-templates select="płyty"/>
                </fo:table-body>
            </fo:table>
    </xsl:template>
    
    <xsl:template match="wykonawcy/wykonawca/płyty">
        <xsl:apply-templates select="./płyta"/>
        <fo:table-row>
            <fo:table-cell number-columns-spanned="6" text-align="right" border-top-style="solid" border-top-width="0.2mm" padding="1mm">
            <fo:block>Liczba rekordów: </fo:block>
            </fo:table-cell>
            <fo:table-cell text-align="center" border-top-style="solid" border-top-width="0.2mm" padding="1mm">
                <fo:block><xsl:value-of select="../ilość_płyt"/></fo:block>
            </fo:table-cell>
        </fo:table-row>
    </xsl:template>
    
    <xsl:template match="wykonawcy/wykonawca/płyty/płyta">
        <fo:table-row>
            <fo:table-cell text-align="center">
                <fo:block><xsl:value-of select="@id"/></fo:block>
            </fo:table-cell>
            <fo:table-cell text-align="left">
                <fo:block font-weight="bold"><xsl:value-of select="tytuł"/></fo:block>
                </fo:table-cell>
            <fo:table-cell text-align="center">
                <fo:block><xsl:value-of select="ranking"/></fo:block>
            </fo:table-cell>
            <fo:table-cell text-align="center">
                <fo:block><xsl:value-of select="liczba_utworów"/></fo:block>
                </fo:table-cell>
            <fo:table-cell text-align="center">
                <fo:block><xsl:value-of select="czas_trwania"/></fo:block>
            </fo:table-cell>
            <fo:table-cell text-align="center">
                <fo:block><xsl:value-of select="cena/VAT"/></fo:block>
            </fo:table-cell>
            <fo:table-cell text-align="center">
                <fo:block font-weight="bold"><xsl:value-of select="cena/brutto"/></fo:block>
            </fo:table-cell>
        </fo:table-row>
    </xsl:template>
    
    <xsl:template match="podsumowanie">
     <fo:table table-layout="fixed" width="50%" font-size="10pt" border-color="black" border-width="0.4mm" border-style="solid" padding="1mm" margin="3mm" >
        <fo:table-column column-width="proportional-column-width(60)"/>
        <fo:table-column column-width="proportional-column-width(40)"/>
        
        <fo:table-header>
            <fo:table-row>
                <fo:table-cell number-columns-spanned="2" text-align="center" border-bottom-style="solid" border-bottom-width="0.2mm">
                <fo:block font-weight="bold" color="#6F0038" padding="1mm">
                    <xsl:text>Podsumowanie</xsl:text>
                </fo:block>
                </fo:table-cell>
            </fo:table-row>
        </fo:table-header>
                
        <fo:table-body>
            <fo:table-row>
                <fo:table-cell padding="1mm"><fo:block font-weight="bold">Laczna liczba wykonawców:</fo:block></fo:table-cell>
                <fo:table-cell padding="1mm"><fo:block><xsl:value-of select="wykonawców"/></fo:block></fo:table-cell>
            </fo:table-row>
            <fo:table-row>
                <fo:table-cell padding="1mm"><fo:block font-weight="bold">Laczna liczba plyt:</fo:block></fo:table-cell>
                <fo:table-cell padding="1mm"><fo:block><xsl:value-of select="płyt"/></fo:block></fo:table-cell>
            </fo:table-row>
            <fo:table-row>
                <fo:table-cell padding="1mm"><fo:block font-weight="bold">Laczna liczba utworow:</fo:block></fo:table-cell>
                <fo:table-cell padding="1mm"><fo:block><xsl:value-of select="utworów"/></fo:block></fo:table-cell>
            </fo:table-row>
            <fo:table-row>
                <fo:table-cell padding="1mm"><fo:block font-weight="bold">Gatunki:</fo:block></fo:table-cell>
                <fo:table-cell padding="1mm"><fo:block><xsl:apply-templates select="./gatunki"/></fo:block></fo:table-cell>
            </fo:table-row>
            <fo:table-row>
                <fo:table-cell padding="1mm"><fo:block font-weight="bold">Sredni ranking:</fo:block></fo:table-cell>
                <fo:table-cell padding="1mm"><fo:block><xsl:value-of select="średni_ranking"/></fo:block></fo:table-cell>
            </fo:table-row>
        </fo:table-body>
        
     </fo:table>
    </xsl:template>
    
    <xsl:template match="podsumowanie/gatunki">
        
        <xsl:for-each select="gatunek/text()[generate-id()
                                       = generate-id(key('jeden_gatunek',.)[1])]">
            <fo:block><xsl:value-of select="."/></fo:block>
        </xsl:for-each>
    </xsl:template>   


</xsl:stylesheet>
