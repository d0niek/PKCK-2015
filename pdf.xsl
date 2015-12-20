<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" 
    xmlns:fo="http://www.w3.org/1999/XSL/Format"
    version="1.0">
<xsl:output encoding="UTF-8" indent="yes" method="xml" standalone="no" omit-xml-declaration="no"/>
    
    <xsl:template match="/kolekcja">  
        <fo:root>

        <fo:layout-master-set>
            <fo:simple-page-master master-name="default" margin-left="15mm" margin-right="15mm" margin-top="15mm" margin-bottom="15mm">
                <fo:region-body />
            </fo:simple-page-master>
        </fo:layout-master-set>
        <fo:page-sequence master-reference="default">
            <fo:flow flow-name="xsl-region-body">
                <xsl:apply-templates />
            </fo:flow>
            
        </fo:page-sequence>

        </fo:root>
    </xsl:template>

    <xsl:template match="nagłówek">
        <fo:block><xsl:value-of select="concat(opis, ' - ', data)"/></fo:block>
    </xsl:template>
    
    <xsl:template match="wykonawcy/wykonawca">
            <fo:table table-layout="fixed" width="100%" font-size="10pt" border-color="black" border-width="0.4mm" border-style="solid">
                <fo:table-column column-width="proportional-column-width(5)"/>
                <fo:table-column column-width="proportional-column-width(30)"/>
                <fo:table-column column-width="proportional-column-width(10)"/>     
                <fo:table-column column-width="proportional-column-width(10)"/>
                <fo:table-column column-width="proportional-column-width(15)"/>
                <fo:table-column column-width="proportional-column-width(10)"/>
                <fo:table-column column-width="proportional-column-width(10)"/> 
                <fo:table-header>
                    <fo:table-row>
                        <fo:table-cell number-columns-spanned="7" text-align="left">
                        <fo:block font-weight="bold" color="#000080" padding="1mm"><xsl:value-of select="nazwa"/></fo:block>
                        <fo:block padding="1mm" text-align="right" ><xsl:value-of select="gatunek"/></fo:block>
                        </fo:table-cell>
                    </fo:table-row>
                </fo:table-header>
                
                <fo:table-body>
                
                    <fo:table-row>
                        <fo:table-cell><fo:block font-weight="bold">ID</fo:block></fo:table-cell>
                        <fo:table-cell><fo:block font-weight="bold">tytuł</fo:block></fo:table-cell>
                        <fo:table-cell><fo:block font-weight="bold">ranking</fo:block></fo:table-cell>
                        <fo:table-cell><fo:block font-weight="bold">utworów</fo:block></fo:table-cell>
                        <fo:table-cell><fo:block font-weight="bold">czas trwania</fo:block></fo:table-cell>
                        <fo:table-cell><fo:block font-weight="bold">netto</fo:block></fo:table-cell>
                        <fo:table-cell><fo:block font-weight="bold">brutto</fo:block></fo:table-cell>
                    </fo:table-row>
                    
                    <xsl:apply-templates select="płyty"/>
                </fo:table-body>
            </fo:table>
    </xsl:template>
    
    <xsl:template match="wykonawcy/wykonawca/płyty">

        <xsl:apply-templates select="./płyta"/>
    </xsl:template>
    
    <xsl:template match="wykonawcy/wykonawca/płyty/płyta">
        <fo:table-row>
            <fo:table-cell text-align="center">
                <fo:block><xsl:value-of select="@id"/></fo:block>
            </fo:table-cell>
            <fo:table-cell text-align="left"><fo:block font-weight="bold">tytuł</fo:block></fo:table-cell>
            <fo:table-cell text-align="center"><fo:block font-weight="bold">ranking</fo:block></fo:table-cell>
            <fo:table-cell text-align="center"><fo:block font-weight="bold">utworów</fo:block></fo:table-cell>
            <fo:table-cell text-align="center"><fo:block font-weight="bold">czas trwania</fo:block></fo:table-cell>
            <fo:table-cell text-align="center"><fo:block font-weight="bold">netto</fo:block></fo:table-cell>
            <fo:table-cell text-align="center"><fo:block font-weight="bold">brutto</fo:block></fo:table-cell>
        </fo:table-row>
    </xsl:template>
    
    <xsl:template match="podsumowanie">
        <fo:block><xsl:value-of select="concat('lol', wykonawców)"/></fo:block>
    </xsl:template>

</xsl:stylesheet>