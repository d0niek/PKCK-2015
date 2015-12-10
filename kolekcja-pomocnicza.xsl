<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet
    version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:ext="http://exslt.org/common"
    exclude-result-prefixes="ext">

    <xsl:output method="xml" encoding="utf-8" indent="yes" />

    <xsl:template match="/">
        <dupa>
            <xsl:apply-templates />
        </dupa>
    </xsl:template>

    <xsl:template match="/kolekcja">
        <xsl:apply-templates />
    </xsl:template>

    <xsl:template match="/kolekcja/nagłówek">
        <nagłówek>
            <xsl:copy-of select="opis" />
            <xsl:apply-templates select="data" />
        </nagłówek>
    </xsl:template>

    <xsl:template match="/kolekcja/nagłówek/data">
        <data>
            <xsl:value-of select="concat(@dzień, '-', @miesiąc, '-2015')" />
        </data>
    </xsl:template>

    <xsl:template match="/kolekcja/płyty/płyta" />

    <xsl:template match="/kolekcja/wykonawcy">
        <wykonawcy>
            <xsl:apply-templates />
        </wykonawcy>
    </xsl:template>

    <xsl:template match="/kolekcja/wykonawcy/wykonawca">
        <wykonawca>
            <xsl:attribute name="id">
                <xsl:value-of select="@id" />
            </xsl:attribute>
            <nazwa>
                <xsl:value-of select="@nazwa" />
            </nazwa>
            <gatunek>
                <xsl:value-of select="@gatunek" />
            </gatunek>
            <ilość_płyt>
                <xsl:value-of select="count(wydał)" />
            </ilość_płyt>
            <płyty>
                <xsl:apply-templates select="wydał" />
            </płyty>
        </wykonawca>
    </xsl:template>

    <xsl:template match="/kolekcja/wykonawcy/wykonawca/wydał">
        <xsl:variable name="nagranieId" select="@nagranie" />

        <płyta>
            <xsl:call-template name="płyta">
                <xsl:with-param name="p" select="/kolekcja/płyty/płyta[@id = $nagranieId]" />
            </xsl:call-template>
        </płyta>
    </xsl:template>

    <xsl:template name="płyta">
        <xsl:param name="p" />

        <tytuł>
            <xsl:value-of select="$p/tytuł_płyty" />
        </tytuł>

        <ranking>
            <xsl:value-of select="$p/ranking" />
        </ranking>

        <xsl:element name="liczba_utworów">
            <xsl:value-of select="count($p/lista_utworów/utwór)" />
        </xsl:element>

        <czas_trwania>
            <xsl:call-template name="czas_trwania">
                <xsl:with-param name="utwory" select="$p/lista_utworów/utwór" />
            </xsl:call-template>
        </czas_trwania>

        <cena>
            <brutto>
                <xsl:value-of select="$p/cena" />
            </brutto>
            <VAT>
                <xsl:call-template name="policzVAT">
                    <xsl:with-param name="brutto" select="$p/cena" />
                    <xsl:with-param name="stawka" select="'0.23'" />
                </xsl:call-template>
            </VAT>
        </cena>
    </xsl:template>

    <xsl:template name="czas_trwania">
        <xsl:param name="utwory" />

        <xsl:variable name="godziny">
            <xsl:for-each select="$utwory">
                <temp_czas>
                    <xsl:value-of select="substring(długość, 4, 2) + substring(długość, 7, 2) div 60" />
                </temp_czas>
            </xsl:for-each>
        </xsl:variable>
        <xsl:variable name="suma" select="sum(ext:node-set($godziny)/*)" />

        <xsl:value-of select="floor($suma)" />
        <xsl:text>:</xsl:text>
        <xsl:value-of select="round(60 * ($suma - floor($suma)))" />
    </xsl:template>

    <xsl:template name="policzVAT">
        <xsl:param name="brutto" />
        <xsl:param name="stawka" />

        <xsl:variable name="brutto_przecinek">
            <xsl:call-template name="doZmiennoprzecinkowej">
                <xsl:with-param name="liczba" select="$brutto" />
            </xsl:call-template>
        </xsl:variable>
        <xsl:variable
            name="kwota_VAT"
            select="concat(floor(substring-before($brutto_przecinek, 'zł') * $stawka * 100) div 100, 'zł')" />

        <xsl:call-template name="zeZmiennoprzecinkowej">
            <xsl:with-param name="liczba" select="$kwota_VAT" />
        </xsl:call-template>
    </xsl:template>

    <xsl:template name="doZmiennoprzecinkowej">
        <xsl:param name="liczba" />

        <xsl:value-of select="translate($liczba, ',', '.')" />
    </xsl:template>

    <xsl:template name="zeZmiennoprzecinkowej">
        <xsl:param name="liczba" />

        <xsl:value-of select="translate($liczba, '.', ',')" />
    </xsl:template>

</xsl:stylesheet>
