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
        <data>
            <dzień>
                <xsl:value-of select="@dzień" />
            </dzień>
            <miesiąc>
                <xsl:value-of select="@miesiąc" />
            </miesiąc>
            <rok>2015</rok>
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
            <xsl:copy-of select="cena" />
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
        <xsl:copy>
            <xsl:variable name="godziny">
                <xsl:for-each select="../lista_utworów/utwór">
                    <temp_czas>
                        <xsl:value-of select="substring(długość, 1, 2) + substring(długość, 4, 5) div 60" />
                    </temp_czas>
                </xsl:for-each>
            </xsl:variable>
            <xsl:variable name="suma" select="sum(ext:node-set($godziny)/*)" />
            <czas_trwania>
                <xsl:value-of select="floor($suma)" />
                <xsl:text>:</xsl:text>
                <xsl:value-of select="round(60 * ($suma - floor($suma)))" />
            </czas_trwania>
        </xsl:copy>
    </xsl:template>

    <xsl:template match="/kolekcja/płyty/płyta/lista_utworów" />

    <xsl:template match="/kolekcja/wykonawcy" />

    <xsl:template match="/kolekcja/wykonawcy/wykonawca">
        <wykonawca_płyty>
            <xsl:value-of select="@nazwa" />
        </wykonawca_płyty>
    </xsl:template>

</xsl:stylesheet>
