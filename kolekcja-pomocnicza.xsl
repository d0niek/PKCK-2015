<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:ext="http://exslt.org/common" exclude-result-prefixes="ext">
    <xsl:output method="xml" encoding="utf-8" indent="yes"/>

    <xsl:template match="/kolekcja">
        <kolekcja>
            <xsl:apply-templates />
        </kolekcja>
    </xsl:template>

    <xsl:template match="/kolekcja/nagłówek">
        <nagłówek>
            <xsl:copy-of select="opis" />
            <xsl:apply-templates select="data" />
        </nagłówek>
    </xsl:template>

    <xsl:template match="/kolekcja/nagłówek/data">
        <xsl:variable name="cała_data">
            <xsl:value-of select="concat(@dzień, '-', @miesiąc, '-2015')" />
        </xsl:variable>
        <data>
            <xsl:value-of select="$cała_data" />
        </data>
    </xsl:template>

    <xsl:template match="/kolekcja/płyty">
        <xsl:apply-templates />
        <podsumowanie>
        333444444444444444444444444444444444444444444
        </podsumowanie>
    </xsl:template>

    <xsl:template match="/kolekcja/płyty/płyta">
        <płyta>
            <xsl:copy-of select="@*" />
            <xsl:copy-of select="tytuł_płyty" />
            <xsl:apply-templates select="wykonawca_płyty" />
            <xsl:copy-of select="ranking" />
            <xsl:apply-templates select="czas_trwania" />
            <xsl:element name="liczba_utworów">
                <xsl:variable name="liczba_utworów_na_płycie">
                    <xsl:value-of select="count(lista_utworów/utwór)" />
                </xsl:variable>
                    <xsl:value-of select="$liczba_utworów_na_płycie" />
            </xsl:element>
            <xsl:apply-templates select="cena" />
            <xsl:apply-templates select="lista_utworów" />
        </płyta>
    </xsl:template>

    <xsl:template match="/kolekcja/płyty/płyta/wykonawca_płyty" >
        <xsl:variable name="wyszukaj_wykonawcę_po_id">
            <xsl:value-of select="../@wykonawca" />
        </xsl:variable>
        <xsl:apply-templates select="/kolekcja/wykonawcy/wykonawca[@id = $wyszukaj_wykonawcę_po_id]" />
    </xsl:template>

    <xsl:template match="/kolekcja/płyty/płyta/czas_trwania">
            <xsl:variable name="godziny">
                <xsl:for-each select="../lista_utworów/utwór">
                    <temp_czas>
                        <xsl:value-of select="substring(długość, 4, 2) + substring(długość, 7, 2) div 60" />
                    </temp_czas>
                </xsl:for-each>
            </xsl:variable>
            <xsl:variable name="suma" select="sum(ext:node-set($godziny)/*)" />
            <czas_trwania>
                <xsl:value-of select="floor($suma)" />
                <xsl:text>:</xsl:text>
                <xsl:value-of select="round(60 * ($suma - floor($suma)))" />
            </czas_trwania>
    </xsl:template>

    <xsl:template match="/kolekcja/płyty/płyta/cena">
        <cena>
            <cena_brutto>
                <xsl:value-of select="." />
            </cena_brutto>
            <VAT>
                <xsl:call-template name="policzVAT">
                        <xsl:with-param name="brutto_zł" select="." />
                        <xsl:with-param name="stawka" select="'0.23'" />
                </xsl:call-template>
            </VAT>
        </cena>
    </xsl:template>

    <xsl:template match="/kolekcja/płyty/płyta/lista_utworów" />

    <xsl:template match="/kolekcja/wykonawcy" />

    <xsl:template match="/kolekcja/wykonawcy/wykonawca">
        <wykonawca_płyty>
            <xsl:value-of select="@nazwa" />
        </wykonawca_płyty>
    </xsl:template>

    <xsl:template name="doZmiennoprzecinkowej">
        <xsl:param name="liczba" />
        <xsl:value-of select="translate($liczba, ',', '.')" />
    </xsl:template>

    <xsl:template name="zeZmiennoprzecinkowej">
        <xsl:param name="liczba" />
        <xsl:value-of select="translate($liczba, '.', ',')" />
    </xsl:template>

    <xsl:template name="policzVAT">
        <xsl:param name="brutto_zł" />
        <xsl:param name="stawka" />
        <xsl:variable name="brutto_przecinek">
            <xsl:call-template name="doZmiennoprzecinkowej">
                    <xsl:with-param name="liczba" select="$brutto_zł" />
            </xsl:call-template>
        </xsl:variable>
        <xsl:variable name="kwota_VAT">
            <!-- floor( x * 100) div 100 - unikamy problemu z liczbami zmiennoprzecinkowymi, dającymi wynik taki jak 21.599999999999998 -->
            <xsl:value-of select="concat(floor(substring-before($brutto_przecinek, 'zł') * $stawka * 100) div 100, 'zł')" />
        </xsl:variable>
        <xsl:call-template name="zeZmiennoprzecinkowej">
            <xsl:with-param name="liczba" select="$kwota_VAT" />
        </xsl:call-template>
    </xsl:template>

</xsl:stylesheet>
